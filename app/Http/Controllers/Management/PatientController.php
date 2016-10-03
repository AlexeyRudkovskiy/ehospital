<?php

namespace App\Http\Controllers\Management;

use App\Patient;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PatientController extends Controller
{

    public function index()
    {
        $patients = auth()->user()->patients;
//        foreach ($patients as $patient) {
//            $name = $patient->name;
//            $birthday = $patient->birthday;
//            $phone = $patient->phone;
//            $homeless = $patient->homeless;
//            $ukrainian = $patient->ukrainian;
//            $hospital_employee = $patient->hospital_employee;
//
//            $patient->setEncrypted([
//                'name', 'birthday', 'phone', 'homeless', 'ukrainian', 'hospital_employee'
//            ]);
//
//            $patient->name = $name;
//            $patient->birthday = $birthday;
//            $patient->phone = $phone;
//            $patient->homeless = $homeless;
//            $patient->ukrainian = $ukrainian;
//            $patient->hospital_employee = $hospital_employee;
//            $patient->save();
//        }

        $patients = auth()->user()->patients()->paginate(config('eh.pagination.limit'));
        return view('management.patient.index')
            ->with('patients', $patients);
    }

    public function show(Patient $patient)
    {
        return view('management.patient.show')
            ->with('patient', $patient);
    }

}
