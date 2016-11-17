<?php

Route::post('cure/{cure}/review', [
    'uses' => 'CureController@postReview',
    'as' => 'cure.review.post'
]);

Route::get('cure/{cure}/review/accept', [
    'uses' => 'CureController@getReviewAccept',
    'as' => 'cure.review.accept'
]);

Route::get('cure/{cure}/review/reject', [
    'uses' => 'CureController@getReviewReject',
    'as' => 'cure.review.reject'
]);

Route::get('cure/{cure}', [
    'uses' => 'CureController@show',
    'as' => 'cure.show'
]);
