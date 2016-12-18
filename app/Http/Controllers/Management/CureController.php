<?php

namespace App\Http\Controllers\Management;

use App\CalendarDay;
use App\Cure;
use App\Events\Notification;
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
        if ($cure->review != null) {
            $newCureReview = $cure->review;
            $newCureReviewData = array_map(function ($item) {
                foreach ($item as $key => $val) {
                    $item['_' . $key] = $val;
                    unset($item[$key]);
                }
                return $item;
            }, $newCureReview['data']);
            $newCureReview['data'] = $newCureReviewData;
            $cure->review = $newCureReview;
        }

        return view('management.cure.show')
            ->with('cure', $cure);
    }

    public function postReview(Cure $cure, Request $request)
    {
        $calendarDays = $request->get('calendar_days');
        $calendarDays = \json_decode($calendarDays, true);

        $calendarDays = array_map(function ($item) {
            foreach ($item as $key => $value) {
                unset($item[$key]);
                $key = substr($key, 1);
                $item[$key] = $value;
            }

            return (object)$item;
        }, $calendarDays);

        $currentData = $cure->review['data'];
        $updatedReview = $cure->review;
        $updatedReview['initial'] = $currentData;
        $updatedReview['data'] = $calendarDays;

        if ($request->has('accepted') && (int)($request->get('accepted')) == 1) {
            $updatedReview['accepted'] = true;

            $notification = new Notification(trans('management.notification.nomenclature.request.title'), 'notification-default');
            $notification->addAction(trans('management.notification.nomenclature.request.action.open'), route('cure.show', $cure->id));

            $cure->department->chiefMedicalOfficer->notify($notification);
        }

        $cure->review = $updatedReview;
        $cure->save();

        return redirect()->route('cure.show', $cure->id);
    }

    public function getReviewAccept(Cure $cure)
    {
        $newReview = $cure->review;

        $newReview['chief_medical_officer_id'] = auth()->id();
        $newReview['chief_medical_officer_date'] = Carbon::now()->format('d.m.Y H:i:s');

        $cure->review = $newReview;

        $calendarDays = $cure->review['data'];
        $calendarDays = array_map(function ($item) {
            return (object)$item;
        }, $calendarDays);

        $nomenclatureRequest = $this->createNomenclatureRequest($cure, $calendarDays);

        $notification = new Notification(trans('management.notification.nomenclature.request.title'), 'notification-default');
        $notification->addAction(trans('management.notification.nomenclature.request.action.open'), route('nomenclatureRequest.show', $nomenclatureRequest->id));

        $users = Permission::find(Permission::PHARMACIST)->users;
        $users->each(function (User $user) use ($notification) {
            $user->notify($notification);
        });

        return $cure->review;
    }

    public function getReviewReject(Cure $cure)
    {
        $newReview = $cure->review;

        $newReview['accepted'] = false;

        $cure->review = $newReview;
        $cure->save();

        $notification = new Notification(trans('management.notification.cure.rejected'), 'notification-danger');
        $notification->addAction(trans('management.notification.cure.action.open'), route('cure.show', $cure->id));

        $cure->department->leader->notify($notification);

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

}
