<?php

Route::get('medicamentIncome', [
    'uses' => 'MedicamentIncomeController@index',
    'as' => 'medicamentIncome.index'
]);