<?php

Route::get('nomenclature/requests', [
    'uses' => 'NomenclatureRequestController@index',
    'as' => 'nomenclature.requests'
]);

Route::get('nomenclature/request/{nomenclatureRequestMerged}', [
    'uses' => 'NomenclatureRequestController@show',
    'as' => 'nomenclature.request.show'
]);

Route::post('nomenclature/request/{nomenclatureRequestMerged}', [
    'uses' => 'NomenclatureRequestController@create',
    'as' => 'nomenclature.request.create'
]);
