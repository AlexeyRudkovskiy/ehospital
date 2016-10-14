<?php

Route::resource('organization', 'OrganizationController');
Route::resource('user', 'UserController');
Route::resource('permission', 'PermissionController');
Route::resource('atcClassification', 'AtcClassificationController');
Route::resource('contractor', 'ContractorController');
Route::resource('manufacturer', 'ManufacturerController');
Route::resource('department', 'DepartmentController');

require_once "patients.php";
require_once "medicaments.php";