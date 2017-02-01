<?php

Route::get('contractor/{contractor}/addAddress', [
    'uses' => 'ContractorController@getAddAddress',
    'as' => 'contractor.address.create'
]);

Route::post('contractor/{contractor}/addAddress', [
    'uses' => 'ContractorController@postAddAddress',
    'as' => 'contractor.address.store'
]);

Route::get('contractor/{contractor}/address/{address}/delete', [
    'uses' => 'ContractorController@deleteAddress',
    'as' => 'contractor.address.delete'
]);

Route::get('contractor/{contractor}/addAgreement', [
    'uses' => 'ContractorController@getAddAgreement',
    'as' => 'contractor.agreement.create'
]);

Route::get('contractor/{contractor}/agreement/{agreement}/delete', [
    'uses' => 'ContractorController@deleteAgreement',
    'as' => 'contractor.agreement.delete'
]);

Route::post('contractor/{contractor}/agreement', [
    'uses' => 'ContractorController@storeAgreement',
    'as' => 'contractor.agreement.store'
]);

Route::resource('contractor', 'ContractorController');