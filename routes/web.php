<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->post('/registrate', 'RegistrationController@Registrate');
$router->post('/login', 'LoginController@Login');

$router->group(['middleware'=>['TokenMiddleware','CoordinatorValidation']], function () use ($router) {
    $router->post('/subordinate', 'UserController@add_subordinate');
    $router->get('/subordinate', 'UserController@get_subordinates');

});
