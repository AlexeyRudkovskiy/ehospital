<?php

Route::get('contractor/{contractor}/addAddress', [
    'uses' => 'ContractorController@getAddAddress',
    'as' => 'contractor.address.create'
]);

Route::resource('contractor', 'ContractorController');