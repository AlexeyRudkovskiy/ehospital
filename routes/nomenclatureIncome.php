<?php

Route::get('nomenclatureIncome', [
    'uses' => 'NomenclatureIncomeController@index',
    'as' => 'nomenclatureIncome.index'
]);

Route::post('nomenclatureIncome/nomenclatures', [
    'uses' => 'NomenclatureIncomeController@postNomenclatures',
    'as' => 'nomenclatureIncome.nomenclatures'
]);