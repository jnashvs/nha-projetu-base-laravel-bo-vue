<?php




//Auth::routes();

//Route::get('/', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Backoffice'], function()
{
    // Controllers Within The "App\Http\Controllers\Admin" Namespace

    Auth::routes();

    //auth routes

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/', 'HomeController@index')->name('home');
    
        Route::get('/test', function () {
            return view('backoffice.test');
        });

        Route::resource('user-manegement', 'UserManagementController');

        Route::get('/files', 'FilesController@index')->name('files');

        Route::get('/file-types', 'FileTypesController@index')->name('file-types');

        //Route::get('/file-types/create', 'FileTypesController@create')->name('create-file-types');

        Route::get('/file-types/edit/{id?}/', 'FileTypesController@edit')->name('edit-file-types');

        Route::post('/file-types/store/{id?}', 'FileTypesController@store')->name('file.types.store');

        Route::post('/file-types/save/{id?}', 'FileTypesController@save')->name('filetypes.save');
        

        Route::delete('/file-types/delete/', 'FileTypesController@delete')->name('delete-file-types');

        //Route::get('/file-types/edit', 'FileTypesController@edit')->name('create-file-types');

        Route::post('/testpost', 'HomeController@testpost')->name('testpost');
    });
    
});


