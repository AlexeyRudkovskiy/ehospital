<?php

Route::get('/department/{department}', function (\App\Department $department) {
    $department->users;
    return $department;
});