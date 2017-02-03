<?php

Route::get('nomenclature/income', [
    'uses' => 'NomenclatureIncomeController@index',
    'as' => 'nomenclature.income.index'
]);

Route::get('nomenclature/income/{nomenclatureIncome}', [
    'uses' => 'NomenclatureIncomeController@show',
    'as' => 'nomenclature.income.show'
]);

Route::post('nomenclature/income/nomenclatures', [
    'uses' => 'NomenclatureIncomeController@postNomenclatures',
    'as' => 'nomenclatureIncome.nomenclatures'
]);