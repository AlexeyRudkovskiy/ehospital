<?php

Route::get('cure/{cure}', [
    'uses' => 'CureController@show',
    'as' => 'cure.show'
]);