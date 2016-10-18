<?php

Route::post('contractor/{contractor}/addAddress', [
    'uses' => 'ContractorController@addressStore',
    'as' => 'api.contractor.address.store'
]);

Route::post('contractor/{contractor}/addAgreement', [
    'uses' => 'ContractorController@agreementStore',
    'as' => 'api.contractor.agreement.store'
]);
