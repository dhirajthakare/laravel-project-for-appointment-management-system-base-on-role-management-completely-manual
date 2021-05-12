<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('/');


Route::post('auth/create','Auth\RegisterController@create')->name('auth.create');
Route::Post('auth/check','Auth\LoginController@check')->name('auth.check');
Route::get('auth/logout','Auth\LoginController@logout')->name('auth.logout');


// Route::group(['middleware'=>['AdvisorMiddleware']],function(){

//     Route::get('advisor/dashboard','roles\AdvisorroleController@dashboard')->name('role.advisor');
//     Route::get('advisor/home','roles\AdvisorroleController@home')->name('role.home');
//     Route::get('auth/login','Auth\LoginController@login')->name('auth.login') ;
//     Route::get('auth/register','Auth\RegisterController@register')->name('auth.register');
//     Route::get('client/dashboard','roles\ClientroleController@dashboard')->name('role.client');

// });
// Route::group(['middleware'=>['ClientMiddleware']],function(){

    

//         Route::get('client/dashboard','roles\ClientroleController@dashboard')->name('role.client');
//         // Route::get('advisor/home','roles\AdvisorroleController@home')->name('role.home');
//         Route::get('auth/login','Auth\LoginController@login')->name('auth.login') ;
//         Route::get('auth/register','Auth\RegisterController@register')->name('auth.register');
        // Route::get('client/dashboard','roles\ClientroleController@dashboard')->name('role.client');
 // Route::get('advisor/dashboard','roles\AdvisorroleController@dashboard')->name('role.advisor');
    // Route::get('advisor/home','roles\AdvisorroleController@home')->name('role.home');
    

  
// });

Route::group(['middleware'=>['AdvisorMiddleware']],function(){


    Route::get('auth/login','Auth\LoginController@login')->name('auth.login') ;
    Route::get('auth/register','Auth\RegisterController@register')->name('auth.register');
    Route::get('dashboard','DashboardController@dashboard')->name('dashboard');
    Route::get('appointment','AppointmentController@appointment')->name('appointment');
    Route::get('appointmentInfo','AppointmentController@appointmentInfo')->name('appointmentInfo');
    Route::any('delete/{id}', 'AppointmentController@delete')->name('delete/{id}');
    Route::post('getappointment', 'AppointmentController@getapp')->name('getappointment');
    Route::post('update', 'AppointmentController@update')->name('update');
    Route::get('client/edit','DashboardController@edit')->name('client.edit');
    Route::post('role/update', 'DashboardController@update')->name('role.update');

    
});

// \\get url data
Route::get('getdata','getDataFromUrlController@test')->name('getdata');




