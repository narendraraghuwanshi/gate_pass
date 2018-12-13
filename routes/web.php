<?php

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
});

Auth::routes();

Route::get('/home', function()
{
    // check the current user and redirect
    if (Laratrust::hasRole('admin')) {
        return Redirect::to('admin');
    } elseif (Laratrust::hasRole('gourd')) {
        return Redirect::to('gourd');
    } elseif (Laratrust::hasRole('staff')) {
        return Redirect::to('staff');
    } elseif (Laratrust::hasRole('visiter')) {
        return Redirect::to('visiter');
    }
});

// Route::get('/home', 'HomeController@index')->name('home');

Route::group([ 'prefix' => 'admin', 'middleware' => ['role:admin']], function() {
    Route::resource('/','AdminController');
    Route::resource('/user','UserController');
    Route::resource('/token','TokenController');


});

Route::group([ 'prefix' => 'gourd', 'middleware' => ['role:gatekeeper']], function() {
    Route::resource('/','GourdController');
    Route::get('/otp/{id}','GourdController@otp')->name('gourd.otp');
    Route::get('/checkuser/{mobile}','GourdController@checkuser')->name('gourd.check');
});

Route::group([ 'prefix' => 'staff', 'middleware' => ['role:staff']], function() {
    Route::resource('/', 'StaffController');
});

Route::group([ 'prefix' => 'visiter', 'middleware' => ['role:visiter']], function() {
    Route::resource('/', 'VisiterController');
});