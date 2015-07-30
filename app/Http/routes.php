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

/**
AUTH ACTION 
*/
Route::get('error', function() {
	return view('errors.api-error');
});

Route::get('auth', function() {
	echo '<pre>' . print_r($_POST, 1) . '</pre>';
});
Route::post('auth', 'Auth\AuthController@postLogin');
    
/**
API ACTION 
************/

App::singleton('oauth2', function() {
	
	$storage = new OAuth2\Storage\Pdo(array('dsn' => 'mysql:dbname=webapi;host=localhost', 'username' => 'janganroot', 'password' => 'letmein!'));
	$server = new OAuth2\Server($storage);
	
	$server->addGrantType(new OAuth2\GrantType\ClientCredentials($storage));
	$server->addGrantType(new OAuth2\GrantType\UserCredentials($storage));
	
	return $server;
});
Route::get('/', function () {
    return view('welcome');
});


