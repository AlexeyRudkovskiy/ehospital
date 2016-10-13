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
    Route::post('medicament/{medicament}/income', [
        'uses' => 'MedicamentController@postIncome',
        'as' => 'api.medicament.income.post'
    ]);

    Route::post('medicament/{medicament}/outgoing', [
        'uses' => 'MedicamentController@postOutgoing',
        'as' => 'api.medicament.outgoing.post'
    ]);

    Route::get('patient/{patient}/comments', [
        'uses' => 'PatientController@getComments',
        'as' => 'api.patient.comments'
    ]);

    Route::get('medicament/{medicament}/history', [
        'uses' => 'MedicamentController@getHistory',
        'as' => 'api.medicament.history'
    ]);

    Route::get('test', function () {
        return auth()->user();
    });

});

