<?php

Route::get('contractor/{contractor}', [
    'uses' => 'ContractorController@show',
    'as' => 'api.contractor.show'
]);

Route::post('contractor/{contractor}/addAddress', [
    'uses' => 'ContractorController@addressStore',
    'as' => 'api.contractor.address.store'
]);

Route::post('contractor/{contractor}/addAgreement', [
    'uses' => 'ContractorController@agreementStore',
    'as' => 'api.contractor.agreement.store'
]);
