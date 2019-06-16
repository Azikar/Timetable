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
    $router->delete('/subordinate/{id}', 'UserController@delete_subordinate');
    $router->post('/subordinate_date/{id}', 'UserController@set_timetable_start_date');
    $router->get('/week_to_end/{id}', 'WeekController@add_week_to_end');
    $router->get('/timetable/{id}', 'WeekController@get_user_timetable');
    $router->get('/week_to_start/{id}', 'WeekController@add_week_to_start');
});
