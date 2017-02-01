<?php

namespace App\Http\Controllers\Management;

use App\CalendarDay;
use App\Cure;
use App\Events\Notification;
use App\Events\Patient\CureChiefReview;
use App\Measure;
use App\Nomenclature;
use App\NomenclatureSet;
use App\Permission;
use App\User;
use App\UserPosition;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CureController extends Controller
{

    public function show(Cure $cure)
    {
        $defaultValue = count($cure->review['accepted']) > 0 ? $cure->review['accepted'] : $cure->review['requested'];
        return view('management.cure.show')
            ->with('cure', $cure)
            ->with('defaultData', $defaultValue);
    }

    public function postReview(Cure $cure, Request $request)
    {
        $calendarValue = $request->get('calendar_value');
        $calendarValue = json_decode($calendarValue);

        $review = $cure['review'];
        $review['accepted'] = $calendarValue;
        $review['accepted_date'] = Carbon::today();
        $review['headNurse'] = true;
        $review['headNurse_id'] = auth()->id();

        $cure->review = $review;
        $cure->save();

        event(new CureChiefReview($cure));

        return $cure;
    }

    public function getReviewAccept(Cure $cure)
    {
        $review = $cure->review;
        $review['chief'] = true;
        $review['chief_date'] = Carbon::today();
        $review['chief_id'] = auth()->id();


        $cure->review = $review;
        $cure->save();

        $measures = [];
        $unique = [];

        $nomenclatures = [];
        $totalNomenclaturesAmount = [];
        $accepted = $review['accepted'];

        $cure->days()->delete();

        foreach ($accepted as $_day => $value) {
            $nomenclaturesAtThisDay = $value['nomenclatures'];
            $procedures = $value['procedures'];

            $day = $cure->days()->create([
                'day' => Carbon::parse($_day)
            ]);

            foreach ($nomenclaturesAtThisDay as $item) {
                // check is nomenclature
                if (array_key_exists('is_set', $item) && $item['is_set'] == false) {
                    if (!array_key_exists($item['nomenclature_id'], $nomenclatures)) {
                        $nomenclatures[$item['nomenclature_id']] = Nomenclature::find($item['nomenclature_id']);
                        $totalNomenclaturesAmount[$item['nomenclature_id']] = 0;
                    }

                    if ($item['unit_id'] == $nomenclatures[$item['nomenclature_id']]->base_unit_id) {
                        $item['amount'] *= $nomenclatures[$item['nomenclature_id']]->amount_in_a_package;
                    }

                    $day->nomenclatures()->attach([
                        $item['nomenclature_id'] => [
                            'amount' => $item['amount'],
                            'unit_id' => $item['unit_id']
                        ]
                    ]);

                    $totalNomenclaturesAmount[$item['nomenclature_id']] += $item['amount'];
                } else if (array_key_exists('is_set', $item) && $item['is_set'] == true) {
                    $set = NomenclatureSet::find($item['set_id']);

                    foreach ($set->items as $setItem) {
                        if (!array_key_exists($setItem->nomenclature_id, $nomenclatures)) {
                            $nomenclatures[$setItem->nomenclature_id] = $setItem->nomenclature;
                            $totalNomenclaturesAmount[$setItem->nomenclature_id] = 0;
                        }

//                        if ($item['unit_id'] == $nomenclatures[$setItem->nomenclature_id]->base_unit_id) {
                            $setItem->amount *= $item['amount'];
//                        }

                        $totalNomenclaturesAmount[$setItem->nomenclature_id] += $setItem->amount;
                    }

                    $day->nomenclatureSets()->attach([
                        $set->id => [
                            'amount' => $item['amount']
                        ]
                    ]);
                }
            }

            foreach ($procedures as $procedure) {
                $day->procedures()->attach([
                    $procedure['id'] => [  ]
                ]);
            }
        }

        $department = $cure->department;

        foreach ($totalNomenclaturesAmount as $nomenclature => $item) {
            $response = $department->calculateAmountToRequest($nomenclatures[$nomenclature], $item);
            $totalNomenclaturesAmount[$nomenclature] = $response['storage'];
            if ($totalNomenclaturesAmount[$nomenclature] <= 0) {
                unset($totalNomenclaturesAmount[$nomenclature]);
            }
        }

//        foreach ($review['accepted'] as $day => $value) {
//            $calendarDate = $cure->days()->create(['day' => Carbon::parse($day)]);
//
//            foreach ($value['nomenclatures'] as $nomenclature) {
//                if (!array_key_exists($nomenclature['measure_id'], $measures)) {
//                    $measures[$nomenclature['measure_id']] = Measure::find($nomenclature['measure_id']);
//                }
//
//                if (!array_key_exists($nomenclature['nomenclature_id'], $unique)) {
//                    $unique[$nomenclature['nomenclature_id']] = 0;
//                }
//
//                $unique[$nomenclature['nomenclature_id']] += $measures[$nomenclature['measure_id']]->amount;
//
//                $calendarDate->nomenclatures()->attach([
//                    $nomenclature['nomenclature_id'] => [
//                        'amount' => $measures[$nomenclature['measure_id']]->amount,
//                        'measure_id' => $nomenclature['measure_id']
//                    ]
//                ]);
//            }
//        }

        $cure->nomenclatureRequest()->create([
            'done' => false,
            'requested' => $totalNomenclaturesAmount,
            'doctor_id' => $cure->user_id,
            'head_nurse_id' => $cure->review['headNurse_id'],
            'chief_medical_officer_id' => $cure->review['chief_id'],
            'ready' => true
        ]);

        return $cure->review;
    }

    public function getReviewReject(Cure $cure)
    {
        $newReview = $cure->review;

        $newReview['headNurse'] = false;

        $cure->review = $newReview;
        $cure->save();

        $notification = new Notification(trans('management.notification.cure.rejected'), 'danger');
        $notification->addAction(trans('management.notification.cure.action.open'), route('cure.show', $cure->id));

        $cure->department->headNurse->notify($notification);

        return redirect()->route('patient.index');
    }

    public function getForm(Cure $cure)
    {
        return view('management.cure.form')
            ->with('cure', $cure);
    }

    private function createNomenclatureRequest(Cure $cure, $calendarDays) {

        $days = [];
        $requestNomenclatures = [];

        foreach ($calendarDays as $item) {
            $from = Carbon::parse($item->from_day);
            $until = Carbon::parse($item->until_day);

            if (!array_key_exists($item->nomenclature_id, $requestNomenclatures)) {
                $requestNomenclatures[$item->nomenclature_id . '_' . $item->unit_id] = 0;
            }

            while ($from <= $until) {
                $requestNomenclatures[$item->nomenclature_id . '_' . $item->unit_id] += $item->amount;

                $_item = clone $item;
                unset($_item->from_day);
                unset($_item->until_day);
                $_item->day = clone $from;
                array_push($days, $_item);
                $from->addDay();
            }
        }

        foreach ($days as $day) {
            $_day = $cure->days()->where('day', $day->day)->first();
            if ($_day == null) {
                $_day = $cure->days()->create([
                    'day' => $day->day
                ]);
            }

            $_day->nomenclatures()->attach([
                $day->nomenclature_id => [
                    'comment' => $day->comment,
                    'unit_id' => $day->unit_id,
                    'amount' => $day->amount
                ]
            ]);
        }

        $nomenclatureRequestObject = new \App\NomenclatureRequest();
        $nomenclatureRequestObject->requested = $requestNomenclatures;
        $nomenclatureRequestObject->cure()->associate($cure);
        $nomenclatureRequestObject->done = false;
        $nomenclatureRequestObject->ready = true;

        $nomenclatureRequestObject->doctor_id = auth()->id();
        $nomenclatureRequestObject->save();

        return $nomenclatureRequestObject;
    }

    public function getCard(Cure $cure)
    {
        return view('management.cure.card')
            ->with('cure', $cure);
    }

}
