<?php

Route::get('nomenclatureRequest/{nomenclatureRequest}', [
    'uses' => 'NomenclatureRequestController@show',
    'as' => 'nomenclatureRequest.show'
]);

Route::post('nomenclatureRequest/{nomenclatureRequest}', [
    'uses' => 'NomenclatureRequestController@create',
    'as' => 'nomenclatureRequest.create'
]);
