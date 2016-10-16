<?php

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

Route::resource('patient', 'PatientController');