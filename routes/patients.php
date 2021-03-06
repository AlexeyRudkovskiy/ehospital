<?php

Route::get('patient/hospitalization', [
    'uses' => 'PatientController@getHospitalization',
    'as' => 'patient.hospitalization'
]);

Route::post('patient/hospitalization', [
    'uses' => 'PatientController@postHospitalization',
    'as' => 'patient.hospitalization.post'
]);

Route::get('patient/{patient}/inspection', [
    'uses' => 'PatientController@getInspection',
    'as' => 'patient.inspection'
]);

Route::post('patient/{patient}/inspection', [
    'uses' => 'PatientController@postInspection',
    'as' => 'patient.inspection.post'
]);

Route::get('patient/{patient}/inspection/edit', [
    'uses' => 'PatientController@getEditInspection',
    'as' => 'patient.inspection.edit'
]);

Route::post('patient/{patient}/inspection/edit', [
    'uses' => 'PatientController@postEditInspection',
    'as' => 'patient.inspection.edit.post'
]);

Route::get('patient/emergency_department', [
    'uses' => 'PatientController@getEmergencyDepartment',
    'as' => 'patient.emergency_department'
]);

Route::resource('patient', 'PatientController');