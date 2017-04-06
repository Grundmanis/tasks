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

Auth::routes();

Route::get('/', 'DashboardController@home');
Route::get('/login/{service}', 'Auth\LoginController@redirectToProvider');
Route::get('/login/{service}/callback', 'Auth\LoginController@handleProviderCallback');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/dashboard', 'DashboardController@index');
});
Route::resource('clients', 'ClientController');