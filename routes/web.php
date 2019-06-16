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
    Route::post('/prefeituras/store', 'PrefeituraController@store')->name('gravar_prefeitura');
    Route::get('/prefeituras/{id_prefeitura}/show', 'PrefeituraController@show')->name('mostrar_prefeitura');
    Route::get('/prefeituras/{id_prefeitura}/organizacao', 'PrefeituraController@organizacao')->name('organizar_prefeitura');

    Route::post('/prefeitura/{id_prefeitura}/secretarias/store', 'SecretariaController@store')->name('gravar_secretaria');
    Route::get('/prefeitura/{id_prefeitura}/secretarias/{id_secretaria}/show', 'SecretariaController@show')->name('mostrar_secretaria');
});

