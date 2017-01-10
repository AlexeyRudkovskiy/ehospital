<?php

Route::group([
    'prefix' => 'search'
], function () {

    Route::post('department', [
        'uses' => "SearchController@departments",
        'as' => 'search.department'
    ]);

    Route::post('users', [
        'uses' => 'SearchController@users',
        'as' => 'search.users'
    ]);

});