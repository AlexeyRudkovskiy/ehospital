<?php

namespace App\Http\Controllers\Management;

use App\Inspection;
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
        foreach ($request->get('blood_transfusions') as $item) {
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

}
