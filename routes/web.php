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

    // -- endereco
    Route::post('/endereco/update', 'EnderecoController@update')->name('atualizar_endereco');
    // -- brasao
    Route::post('/brasao/update', 'BrasaoController@update')->name('atualizar_endereco');

    // -- prefeitura (admin)
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/prefeituras', 'PrefeituraController@index')->name('prefeituras');
    Route::get('/prefeituras/create', 'PrefeituraController@create')->name('nova_prefeitura');
    Route::post('/prefeituras/store', 'PrefeituraController@store')->name('gravar_prefeitura');
    Route::get('/prefeituras/{id_prefeitura}/show', 'PrefeituraController@show')->name('mostrar_prefeitura');
    Route::get('/prefeituras/{id_prefeitura}/organizacao', 'PrefeituraController@organizacao')->name('organizar_prefeitura');

    // -- secretarias
    Route::post('/prefeitura/{id_prefeitura}/secretarias/store', 'SecretariaController@store')->name('gravar_secretaria');
    Route::post('/prefeitura/{id_prefeitura}/secretarias/update', 'SecretariaController@update')->name('atualizar_secretaria');
    Route::get('/prefeitura/{id_prefeitura}/secretarias/{id_secretaria}/show', 'SecretariaController@show')->name('mostrar_secretaria');
    Route::get('/prefeitura/{id_prefeitura}/secretarias/{id_secretaria}/delete', 'SecretariaController@delete')->name('excluir_secretaria');

    // -- departamentos
    Route::post('/prefeitura/{id_prefeitura}/departamentos/store', 'DepartamentoController@store')->name('gravar_departamento');
    Route::post('/prefeitura/{id_prefeitura}/departamentos/update', 'DepartamentoController@update')->name('atualizar_departamento');
    Route::get('/prefeitura/{id_prefeitura}/departamentos/{id_departamento}/show', 'DepartamentoController@show')->name('mostrar_departamento');
    Route::get('/prefeitura/{id_prefeitura}/departamentos/{id_departamento}/delete', 'DepartamentoController@delete')->name('excluir_departamento');

    // -- órgãos
    Route::post('/prefeitura/{id_prefeitura}/orgaos/store', 'OrgaoController@store')->name('gravar_orgao');
    Route::post('/prefeitura/{id_prefeitura}/orgaos/update', 'OrgaoController@update')->name('atualizar_orgao');
    Route::get('/prefeitura/{id_prefeitura}/orgaos/{id_orgao}/show', 'OrgaoController@show')->name('mostrar_orgao');
    Route::get('/prefeitura/{id_prefeitura}/orgaos/{id_orgao}/delete', 'OrgaoController@delete')->name('excluir_orgao');

    // -- Fundações
    Route::post('/prefeitura/{id_prefeitura}/fundacoes/store', 'FundacaoController@store')->name('gravar_fundacao');
    Route::post('/prefeitura/{id_prefeitura}/fundacoes/update', 'FundacaoController@update')->name('atualizar_fundacao');
    Route::get('/prefeitura/{id_prefeitura}/fundacoes/{id_fundacao}/show', 'FundacaoController@show')->name('mostrar_fundacao');
    Route::get('/prefeitura/{id_prefeitura}/fundacoes/{id_fundacao}/delete', 'FundacaoController@delete')->name('excluir_fundacao');

    // -- Servidores
    Route::post('/prefeitura/{id_prefeitura}/servidores/store', 'ServidorController@store')->name('gravar_servidor');
    Route::post('/prefeitura/{id_prefeitura}/servidores/update', 'ServidorController@update')->name('atualizar_servidor');
    Route::get('/prefeitura/{id_prefeitura}/servidores/{id_servidor}/show', 'ServidorController@show')->name('mostrar_servidor');
    Route::get('/prefeitura/{id_prefeitura}/servidores/list', 'ServidorController@list')->name('listar_servidor');
    Route::get('/prefeitura/{id_prefeitura}/servidores/{id_servidor}/delete', 'ServidorController@delete')->name('excluir_servidor');
});

