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


Route::get('/', 'VehiclesController@index');
Route::get('/vehicles/dashboard', 'VehiclesController@index')->name('vehicles-dashboard');
Route::get('/vehicles/create', 'VehiclesController@create')->name('vehicles-create');
Route::post('/vehicles/create', 'VehiclesController@create')->name('vehicles-insert');
