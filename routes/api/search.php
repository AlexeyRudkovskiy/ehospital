<?php

Route::group([
    'prefix' => 'search'
], function () {

    Route::post('department', [
        'uses' => "SearchController@departments",
        'as' => 'search.department'
    ]);

    Route::post('department/{department}/users', [
        'uses' => 'SearchController@departmentUsers',
        'as' => 'search.department.users.post'
    ]);

    Route::get('department/{department}/users', [
        'uses' => 'SearchController@departmentUsersList',
        'as' => 'search.department.users'
    ]);

    Route::post('users', [
        'uses' => 'SearchController@users',
        'as' => 'search.users'
    ]);

    Route::post('nomenclatures', [
        'uses' => 'SearchController@nomenclatures',
        'as' => 'search.nomenclatures'
    ]);

    Route::get('nomenclatures/{nomenclature}', [
        'uses' => 'SearchController@nomenclature',
        'as' => 'search.nomenclature'
    ]);

    Route::post('units', [
        'uses' => 'SearchController@units',
        'as' => 'search.units'
    ]);

});