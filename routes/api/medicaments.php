<?php

Route::post('medicament/{medicament}/income', [
    'uses' => 'MedicamentController@postIncome',
    'as' => 'api.medicament.income.post'
]);

Route::post('medicament/{medicament}/outgoing', [
    'uses' => 'MedicamentController@postOutgoing',
    'as' => 'api.medicament.outgoing.post'
]);

Route::get('medicament/{medicament}/history', [
    'uses' => 'MedicamentController@getHistory',
    'as' => 'api.medicament.history'
]);

Route::get('medicaments', [
    'uses' => 'MedicamentController@getList',
    'as' => 'api.medicament.list'
]);
