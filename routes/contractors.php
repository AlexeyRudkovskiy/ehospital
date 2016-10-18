<?php

Route::get('contractor/{contractor}/addAddress', [
    'uses' => 'ContractorController@getAddAddress',
    'as' => 'contractor.address.create'
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

Route::resource('contractor', 'ContractorController');