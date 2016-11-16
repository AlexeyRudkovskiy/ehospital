<?php

Route::post('cure/{cure}/review', [
    'uses' => 'CureController@postReview',
    'as' => 'cure.review.post'
]);

Route::get('cure/{cure}', [
    'uses' => 'CureController@show',
    'as' => 'cure.show'
]);
