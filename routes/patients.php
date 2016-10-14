<?php

Route::get('patient/{patient}/inspection', [
    'uses' => 'PatientController@getInspection',
    'as' => 'patient.inspection'
]);

Route::post('patient/{patient}/inspection', [
    'uses' => 'PatientController@postInspection',
    'as' => 'patient.inspection.post'
]);

Route::resource('patient', 'PatientController');