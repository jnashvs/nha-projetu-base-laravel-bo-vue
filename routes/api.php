<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//files 
Route::post('/files/upload', 'Backoffice\FilesController@fileStore')->name('uploadFiles');
Route::get('/files/all', 'Backoffice\FilesController@allFiles')->name('allFiles');
Route::delete('/files/remove/{id}', 'Backoffice\FilesController@removeFile')->name('removeFile');

//file types
Route::post('/file-types/store', 'Backoffice\FileTypesController@store')->name('file-types-store');

Route::get('/file-types/all', 'Backoffice\FileTypesController@getAll')->name('file-types-all');

Route::get('/file-types/{id}', 'Backoffice\FileTypesController@getFileType')->name('file-type-find');




