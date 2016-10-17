<?php

Route::post('contractor/{contractor}/addAddress', [
    'uses' => 'ContractorController@store',
    'as' => 'api.contractor.address.store'
]);