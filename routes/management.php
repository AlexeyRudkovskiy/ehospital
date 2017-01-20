<?php

require_once "contractors.php";

require_once "patients.php";
require_once "cures.php";
require_once "nomenclatures.php";
require_once "nomenclatureRequest.php";
require_once "nomenclatureIncome.php";
require_once "departments.php";

Route::resource('organization', 'OrganizationController');
Route::resource('user', 'UserController');
Route::resource('permission', 'PermissionController');
Route::resource('atcClassification', 'AtcClassificationController');
Route::resource('manufacturer', 'ManufacturerController');
Route::resource('department', 'DepartmentController');

Route::resource('sourceOfFinancing', 'SourceOfFinancingController');
