<?php

Route::resource('organization', 'OrganizationController');
Route::resource('user', 'UserController');
Route::resource('permission', 'PermissionController');
Route::resource('atcClassification', 'AtcClassificationController');
Route::resource('contractor', 'ContractorController');
Route::resource('manufacturer', 'ManufacturerController');
Route::resource('department', 'DepartmentController');
Route::resource('patient', 'PatientController');

require_once "medicaments.php";