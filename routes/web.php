<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    /*if (auth()->guest()) {
        return redirect()->route('login');
    }*/
    return redirect()->route('organization.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group([
    'prefix' => 'management',
    'namespace' => 'Management',
    'middleware' => [ 'web' ]
], function () {
    require_once __DIR__ . '/management.php';
});
