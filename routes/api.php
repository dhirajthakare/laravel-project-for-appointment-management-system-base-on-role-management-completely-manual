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

Route::get('/user/formdata','getDataFromUrlController@formdata')->name('formdata');
// Route::any('/user/delete/{id}', 'AppointmentController@delete')->name('delete.{id}');
Route::any('/user/delete/{id}','getDataFromUrlController@delete')->name('delete.{id}');
Route::post('user/insert','getDataFromUrlController@insert')->name('user.insert');
Route::post('user/update','getDataFromUrlController@update')->name('user.update');



