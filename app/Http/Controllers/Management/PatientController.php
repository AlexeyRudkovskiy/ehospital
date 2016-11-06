<?php

namespace App\Http\Controllers\Management;

use App\Cure;
use App\CureStatus;
use App\Inspection;
use App\ListItem;
use App\Patient;
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

    public function postHospitalization(Request $request)
    {
        $patient = Patient::find($request->get('patient_id'));
        $patient->cures()->create([
            'hospitalization_date' => $request->get('hospitalization_date'),
            'user_id' => $request->get('doctor_select'),
            'cure_status_id' => 1, // 1 - income, госпитализация
            'department_id' => $request->get('department_id'),
            'diagnosis' => $request->get('diagnosis'),
            'comment' => $request->get('comment'),
            'discharge_date' => $request->get('discharge_date')
        ]);

        return redirect()->route('patient.show', $request->get('patient_id'));
    }

}
