<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', 'WelcomeController@index');

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::get("/register","HomeController@registro");

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get("/email-cadastro",array(
    "as"    =>  "email-cadastro",
    "uses"  =>  "EmailController@create"
));

Route::get("/emails-lista",array(
    "as"    =>  "emails-lista",
    "uses"  =>  "EmailController@index"
));

Route::get("/painel",array(
    "as"    =>  "painel",
    "uses"  =>  "PainelController@index"
));

Route::get('enviar-emails-clientes-layout',array(
    'as'    =>  'enviar-emails-clientes-layout',
    'uses'  =>  'EmailController@enviarEmailClientesLayout'
));

Route::get('mesagem-emails',array(
    'as'    =>  'mesagem-emails',
    'uses'  =>  'MensagemEmailController@create'
));

Route::get('/lojas-cadastro',array(
    'as'    =>  'lojas-cadastro',
    'uses'  =>  'LojaController@create'
));

Route::get('/desativar-email/{id}',array(
    'as'    =>  'desativar-email',
    'uses'  =>  'EmailController@destroy'
));

Route::get('disparar-emails',array(
    'as'    =>  'disparar-emails',
    'uses'  =>  'EmailController@dispararEmails'
));

Route::post("/mesagem-emails", "MensagemEmailController@index");

Route::post("/deletar-usuario", "PainelController@destroy");

Route::any("/loja", "LojaController@index");

Route::post("/lojas-cadastro", "LojaController@store");

Route::post("/mesagem-emails-cadastro", "MensagemEmailController@store");

Route::post("/enviar-emails-clientes-layout", "EmailController@enviarEmailClientesLayout");

Route::post("/enviar-emails-clientes", "EmailController@enviarEmailClientes");

Route::post("/relatorio-caixa", "RelatorioController@relatorioCaixa");

Route::get("/relatorio-caixa-data/{id}/", "RelatorioController@relatorioCaixaData");

Route::post("/relatorio-loja", "RelatorioController@relatorioLoja");

Route::get("/relatorio-loja-data/{id}/", "RelatorioController@relatorioLojaData");

Route::post("/relatorio-emails", "RelatorioController@relatorioEmails");

Route::get("/relatorio-emails-data", "RelatorioController@relatorioEmailsData");

Route::any("/relatorio-usuarios", "RelatorioController@relatorioUsuarios");

Route::post("email-cadastro", "EmailController@store");

