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
    return redirect()->route('nomenclature.index');
});

Route::get('logout', function () {
    auth()->logout();
    session()->flush();
    session()->regenerate();
    return redirect('/');
});

Route::get('test', function () {
    return view('test_echo');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group([
    'prefix' => 'management',
    'namespace' => 'Management',
    'middleware' => [ 'web', 'auth' ]
], function () {
    require_once __DIR__ . '/management.php';
});

Route::get('income_template.html', function () {
    return view('templates/income_template');
});

Route::get('lang.json', function () {
    return trans('management');
});
