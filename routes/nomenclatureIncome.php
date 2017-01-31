<?php

Route::get('nomenclature/income', [
    'uses' => 'NomenclatureIncomeController@index',
    'as' => 'nomenclatureIncome.index'
]);

Route::get('nomenclature/income/{nomenclature_income_id}', [
    'uses' => 'NomenclatureIncomeController@show',
    'as' => 'nomenclatureIncome.show'
]);

Route::post('nomenclature/income/nomenclatures', [
    'uses' => 'NomenclatureIncomeController@postNomenclatures',
    'as' => 'nomenclatureIncome.nomenclatures'
]);