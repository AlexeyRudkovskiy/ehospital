<?php

Route::resource('medicament/{medicament}/batch', 'Medicament\BatchController', [
    'as' => 'medicament',
    'exclude' => ['show']
]);
Route::resource('medicament', 'MedicamentController');
Route::get('medicament/{medicament}/income', [
    'uses' => 'MedicamentController@getIncome',
    'as' => 'medicament.income'
]);
