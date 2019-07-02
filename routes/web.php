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
//New Vehicle
Route::get('/vehicles/create', 'VehiclesController@create')->name('vehicles-create');
Route::post('/vehicles/create', 'VehiclesController@create')->name('vehicles-insert');
//Set Vehicle Color
Route::get('/vehicles/{id}/set-color', 'VehiclesController@setColor')->name('vehicles-set-color');
Route::patch('/vehicles/{id}/color-update', 'VehiclesController@setColor')->name('vehicles-update');
//Delete Vehicle
Route::get('/vehicles/{id}/confirm-delete', 'VehiclesController@confirmDelete')->name('vehicles-confirm-delete');
Route::delete('/vehicles/{id}/delete', 'VehiclesController@remove')->name('vehicles-delete');
