<?php

Route::group(['namespace' => 'Backoffice'], function () {

    Auth::routes();

    Route::group(['middleware' => ['auth']], function () {

        Route::get('/test', function () {
            return view('backoffice.test');
        });
        Route::get('/files', 'FilesController@index')->name('files');

        Route::controller(HomeController::class)->group(function () {
            Route::get('/', 'index')->name('home');
            Route::post('/testpost', 'testpost')->name('testpost');
        });

        Route::controller(UserManagementController::class)->group(function () {
            Route::get('/user-management/edit/{id?}/', 'edit')->name('user-management.edit');
            Route::resource('user-management', 'UserManagementController');
        });

        Route::controller(FileTypesController::class)->group(function () {
            Route::get('/file-types/edit/{id?}/', 'edit')->name('edit-file-types');
            Route::post('/file-types/store/{id?}', 'store')->name('file.types.store');
            Route::post('/file-types/save/{id?}', 'save')->name('filetypes.save');
            Route::delete('/file-types/delete/', 'delete')->name('delete-file-types');
            //Route::get('/file-types/edit', 'FileTypesController@edit')->name('create-file-types');
            //Route::get('/file-types/create', 'FileTypesController@create')->name('create-file-types');
        });

    });
});
