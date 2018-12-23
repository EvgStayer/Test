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

Route::get('/admin', 'Admin\FilterController@index')->name('index');
Route::post('/admin', 'Admin\FilterController@show');

Route::get('/admin/client/add', 'Admin\ClientController@showForm');
Route::post('/admin/client/add', 'Admin\ClientController@add');

Route::get('/admin/client/{id}', 'Admin\ClientController@show');
Route::post('/admin/client/{id}', 'Admin\ClientController@enter');


