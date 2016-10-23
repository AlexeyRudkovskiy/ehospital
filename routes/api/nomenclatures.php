<?php

Route::post('nomenclature/{nomenclature}/income', [
    'uses' => 'NomenclatureController@postIncome',
    'as' => 'api.nomenclature.income.post'
]);

Route::post('nomenclature/{nomenclature}/outgoing', [
    'uses' => 'NomenclatureController@postOutgoing',
    'as' => 'api.nomenclature.outgoing.post'
]);

Route::get('nomenclature/{nomenclature}/history', [
    'uses' => 'NomenclatureController@getHistory',
    'as' => 'api.nomenclature.history'
]);

Route::get('nomenclatures', [
    'uses' => 'NomenclatureController@getList',
    'as' => 'api.nomenclature.list'
]);
