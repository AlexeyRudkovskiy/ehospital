<?php

Route::get('nomenclatureIncome', [
    'uses' => 'NomenclatureIncomeController@index',
    'as' => 'nomenclatureIncome.index'
]);