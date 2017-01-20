<?php

Route::get('/department/current', [
    'uses' => 'DepartmentController@current',
    'as' => 'department.current'
]);