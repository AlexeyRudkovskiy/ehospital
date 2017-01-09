<?php

Route::get('nomenclatureIncome', [
    'uses' => 'NomenclatureIncomeController@index',
    'as' => 'nomenclatureIncome.index'
]);

Route::get('nomenclatureIncome/{nomenclature_income_id}', [
    'uses' => 'NomenclatureIncomeController@show',
    'as' => 'nomenclatureIncome.show'
]);

Route::post('nomenclatureIncome/nomenclatures', [
    'uses' => 'NomenclatureIncomeController@postNomenclatures',
    'as' => 'nomenclatureIncome.nomenclatures'
]);