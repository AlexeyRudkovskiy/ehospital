<?php

Route::get('/department/current', [
    'uses' => 'DepartmentController@current',
    'as' => 'department.current'
]);

Route::group([
    'prefix' => '/department/current/',
    'namespace' => 'Department'
], function () {
    Route::get('set/{nomenclatureSet}', [
        'uses' => 'NomenclatureSetController@show',
        'as' => 'department.nomenclature_set.show'
    ]);

    Route::get('set/{nomenclatureSet}/item/create', [
        'uses' => 'NomenclatureSetController@createItem',
        'as' => 'department.nomenclature_set.item.create'
    ]);

    Route::post('set/{nomenclatureSet}/item', [
        'uses' => 'NomenclatureSetController@storeItem',
        'as' => 'department.nomenclature_set.item.store'
    ]);

    Route::get('set/{nomenclatureSet}/item/{nomenclatureSetItem}', [
        'uses' => 'NomenclatureSetController@editItem',
        'as' => 'department.nomenclature_set.item.edit'
    ]);

    Route::post('set/{nomenclatureSet}/item/{nomenclatureSetItem}', [
        'uses' => 'NomenclatureSetController@updateItem',
        'as' => 'department.nomenclature_set.item.update'
    ]);

    Route::get('set/{nomenclatureSet}/item/delete/{nomenclatureSetItem}', [
        'uses' => 'NomenclatureSetController@deleteItem',
        'as' => 'department.nomenclature_set.item.delete'
    ]);

    Route::get('set/{nomenclatureSet}/item/{nomenclatureSetItem}/preload', [
        'uses' => 'NomenclatureSetController@preloadItem',
        'as' => 'department.nomenclature_set.item.preload'
    ]);
});