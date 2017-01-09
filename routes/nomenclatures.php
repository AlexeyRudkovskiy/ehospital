<?php

Route::resource('nomenclature/{nomenclature}/batch', 'Nomenclature\BatchController', [
    'as' => 'nomenclature',
    'exclude' => ['show']
]);
Route::resource('nomenclature', 'NomenclatureController');
Route::get('nomenclature/{nomenclature}/income', [
    'uses' => 'NomenclatureController@getIncome',
    'as' => 'nomenclature.income'
]);
Route::get('nomenclature/{nomenclature}/outgoing', [
    'uses' => 'NomenclatureController@getOutgoing',
    'as' => 'nomenclature.outgoing'
]);
