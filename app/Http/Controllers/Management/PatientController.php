<?php

namespace App\Http\Controllers\Management;

use App\Cure;
use App\CureStatus;
use App\Events\Nomenclature\RequestEvent;
use App\Events\Notification;
use App\Events\Patient\CureHeadNurseReview;
use App\Events\Patient\HospitalizationEvent;
use App\Inspection;
use App\ListItem;
use App\Measure;
use App\Nomenclature;
use App\NomenclatureRequest;
use App\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PatientController extends Controller
{

    public function index()
    {
        $patients = auth()->user()->patients()->paginate(config('eh.pagination.limit'));
        return view('management.patient.index')
            ->with('patients', $patients);
    }

    public function show(Patient $patient)
    {
        return view('management.patient.show')
            ->with('patient', $patient);
    }

    public function create()
    {
        return view('management.patient.create')
            ->with('patient', new Patient());
    }

    public function store(Requests\PatientRequest $request)
    {
        $data = $request->only($request->fields);
        $patient = new Patient($data);
        $patient->user_id = auth()->id();
        $patient->created_by_id = auth()->id();
        $patient->encrypt();
        $patient->save();

            session()->flash('message', json_encode([
            'text' => trans('management.notification.patient.created'),
            'type' => 'notification-default'
        ]));

        return redirect()->route('patient.inspection', $patient);
    }

    public function edit(Patient $patient)
    {
        return view('management.patient.edit')
            ->with('patient', $patient);
    }

    public function update(Patient $patient, Requests\PatientRequest $request)
    {
        $patient->fill($request->only($request->fields));
        $patient->encrypt($request->fields);
        $patient->update();

        session()->flash('message', json_encode([
            'text' => trans('management.notification.patient.modified'),
            'type' => 'notification-default'
        ]));

        return redirect()->route('patient.show', $patient->id);
    }

    /**
     * @param Patient $patient
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getInspection(Patient $patient)
    {
        return view('management.patient.inspection.create')
            ->with('patient', $patient);
    }

    /**
     * @param Patient $patient
     * @param Requests\PatientInspectionRequest $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function postInspection(Patient $patient, Requests\PatientInspectionRequest $request)
    {
        $inspection = $patient->inspection()->create($request->only($request->fields));
        foreach ($request->get('blood_transfusions')['new'] as $item) {
            $inspection->bloodTransfusions()->create([
                'data' => $item,
                'key' => 'blood_transfusion'
            ]);
        }
        return $inspection;
    }

    public function getEditInspection(Patient $patient)
    {
        return view('management.patient.inspection.edit')
            ->with('patient', $patient);
    }

    public function postEditInspection(Patient $patient, Requests\PatientInspectionRequest $request)
    {
        $patient->inspection->update($request->only($request->fields));

        $bloodTransfusions = $request->get('blood_transfusions');

        if (array_key_exists('edit', $bloodTransfusions)) {
            $currentBloodTransfusions = $patient->inspection->bloodTransfusions;
            $editedRaw = $bloodTransfusions['edit'];
            $edited = array_keys($editedRaw);
            $currentBloodTransfusions->reject(function ($val, $key) use ($edited) {
                return in_array($val->id, $edited);
            })->each(function (ListItem $listItem) {
                $listItem->delete();
            });

            $currentBloodTransfusions->reject(function ($val, $key) use ($edited) {
                return !in_array($val->id, $edited);
            })->map(function (ListItem $item) use ($editedRaw) {
                $item->data = $editedRaw[$item->id];
                return $item;
            })->each(function (ListItem $listItem) {
                $listItem->save();
            });
        }

        if (array_key_exists('new', $bloodTransfusions)) {
            foreach ($bloodTransfusions['new'] as $item) {
                $patient->inspection->bloodTransfusions()->create([
                    'data' => $item,
                    'key' => 'blood_transfusion'
                ]);
            }
        }

        return $request->all();
    }

    public function getHospitalization()
    {

    }

    public function postHospitalization (Request $request) {
        $data = $request->all();
        $data['hospitalization_date'] = Carbon::parse($data['hospitalization_date']);
        $data['calendar_value'] = json_decode($data['calendar_value']);

        $cure = new Cure();

        $cure->patient_id = $request->get('patient_id');
        $cure->department_id = $request->get('department_id');
        $cure->user_id = 1;
        $cure->cure_status_id = 1;
        $cure->hospitalization_date = $data['hospitalization_date'];
        $cure->diagnosis = $request->get('diagnosis');
        $cure->review = [
            'destination_list' => $data['calendar_value'],
            'requested' => $data['calendar_value'],
            'accepted' => new \stdClass(),
            'headNurse' => false,
            'chief' => false,
            'accepted_date' => null,
            'chief_date' => null,
            'requested_date' => Carbon::today(),
            'headNurse_id' => 0,
            'chief_id' => 0
        ];

        $cure->save();
        event(new CureHeadNurseReview($cure));

//        $nomenclatureRequest = $cure->nomenclatureRequest()->create([
//            'done' => false,
//            'requested' => $uniqueNomenclaturesCount,
//            'doctor_id' => 1
//        ]);

//        foreach ($data['calendar_value'] as $day => $value) {
//            $calendarDay = $cure->days()->create([
//                'day' => Carbon::parse($day)
//            ]);
//
//            foreach ($value->nomenclatures as $nomenclature) {
//                $calendarDay->nomenclatures()->attach([
//                    $nomenclature->nomenclature_id => [
//                        'amount' => $measures[$nomenclature->measure_id]->amount,
//                        'measure_id' => $nomenclature->measure_id,
//                        'comment' => ''
//                    ]
//                ]);
//            }
//        }

        return $cure;
    }

    public function postHospitalization_old(Request $request)
    {
        $patient = Patient::find($request->get('patient_id'));

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

        // make dates for each record

        $days = [];
        $requestNomenclatures = [];

//        foreach ($calendarDays as $item) {
//            $from = Carbon::parse($item->from_day);
//            $until = Carbon::parse($item->until_day);
//
//            if (!array_key_exists($item->nomenclature_id, $requestNomenclatures)) {
//                $requestNomenclatures[$item->nomenclature_id . '_' . $item->unit_id] = 0;
//            }
//
//            while ($from <= $until) {
//                $requestNomenclatures[$item->nomenclature_id . '_' . $item->unit_id] += $item->amount;
//
//                $_item = clone $item;
//                unset($_item->from_day);
//                unset($_item->until_day);
//                $_item->day = clone $from;
//                array_push($days, $_item);
//                $from->addDay();
//            }
//        }

        $cure = $patient->cures()->create([
            'hospitalization_date' => $request->get('hospitalization_date'),
            'user_id' => $request->get('doctor_select'),
            'cure_status_id' => 1, // 1 - income, госпитализация
            'department_id' => $request->get('department_id'),
            'diagnosis' => $request->get('diagnosis'),
            'comment' => $request->get('comment'),
            'discharge_date' => $request->get('discharge_date'),
            'review' => [
                'accepted' => false,
                'data' => $calendarDays
            ]
        ]);

//        foreach ($days as $day) {
//            $_day = $cure->days()->where('day', $day->day)->first();
//            if ($_day == null) {
//                $_day = $cure->days()->create([
//                    'day' => $day->day
//                ]);
//            }
//
//            $_day->nomenclatures()->attach([
//                $day->nomenclature_id => [
//                    'comment' => $day->comment,
//                    'unit_id' => $day->unit_id,
//                    'amount' => $day->amount
//                ]
//            ]);
//        }

//        $nomenclatureRequestObject = new \App\NomenclatureRequest();
//        $nomenclatureRequestObject->requested = $requestNomenclatures;
//
//        $nomenclatureRequestObject->doctor_id = auth()->id();
//        $nomenclatureRequestObject->save();

        $notification = new Notification(trans('management.label.cure.review.need'), 'notification-default');
        $notification->addAction(trans('management.notification.cure.action.open'), route('cure.show', $cure->id));
        auth()->user()->department->leader->notify($notification);

//        event(new RequestEvent($nomenclatureRequestObject));

        return redirect()->route('patient.show', $request->get('patient_id'));
    }

    public function getEmergencyDepartment()
    {
        return [1,2,3];
    }

}
