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

    Route::post('procedures', [
        'uses' => 'SearchController@procedures',
        'as' => 'search.procedures'
    ]);

    Route::get('procedure/{procedure}', [
        'uses' => 'SearchController@procedure',
        'as' => 'search.procedure'
    ]);

    Route::post('source_of_financings', [
        'uses' => 'SearchController@source_of_financing',
        'as' => 'search.source_of_financing'
    ]);

    Route::post('contractors', [
        'uses' => 'SearchController@contractors',
        'as' => 'search.contractors'
    ]);

    Route::post('sets/{department}', [
        'uses' => 'SearchController@sets',
        'as' => 'search.sets'
    ]);

    Route::get('sets/{department}', [
        'uses' => 'SearchController@sets',
        'as' => 'search.sets_default'
    ]);

});
