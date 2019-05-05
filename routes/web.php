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

Route::group(['middleware' => ['web', 'activity']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/prefeituras', 'PrefeituraController@index')->name('prefeituras');
    Route::get('/prefeituras/create', 'PrefeituraController@create')->name('nova_prefeitura');
});

