<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});



$router->group(['prefix' => 'profiles'], function () use ($router) {
    $router->get('/', 'ProfileController@index');
    $router->get('/{id}', 'ProfileController@show');
});

$router->group(['prefix' => 'profile-attributes'], function () use ($router) {
    $router->get('/', 'ProfileAttributeController@index');
    $router->get('/{id}', 'ProfileAttributeController@show');
});





$router->group(['middleware' => 'auth.token'], function () use ($router) {
    $router->post('/profiles', 'ProfileController@store');
    $router->put('/profiles/{id}', 'ProfileController@update');
    $router->delete('/profiles/{id}', 'ProfileController@destroy');

    $router->post('/profile-attributes', 'ProfileAttributeController@store');
    $router->put('/profile-attributes/{id}', 'ProfileAttributeController@update');
    $router->delete('/profile-attributes/{id}', 'ProfileAttributeController@destroy');
});
