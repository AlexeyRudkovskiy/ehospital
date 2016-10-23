<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group([
    'namespace' => 'API'
], function () {
    Route::get('patient/{patient}/comments', [
        'uses' => 'PatientController@getComments',
        'as' => 'api.patient.comments'
    ]);

    Route::get('test', function () {
        return auth()->user();
    });

    require_once 'api/nomenclatures.php';

    require_once 'api/contractors.php';

});

