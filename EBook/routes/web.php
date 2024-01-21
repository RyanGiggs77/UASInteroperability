<?php

/** @var \Laravel\Lumen\Routing\Router $router */
use Illuminate\Support\Facades\Route;

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

$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('/register', 'AuthController@register');
    $router->post('/login', 'AuthController@login');
});

Route::group(['middleware' => ['auth']], function ($router){
$router->get('/book-reviews', 'BookReviewController@index');
$router->get('/book-reviews/{id}', 'BookReviewController@show');
$router->post('/book-reviews/{id}', 'BookReviewController@store');
$router->put('/book-reviews/{id}', 'BookReviewController@update');
$router->delete('/book-reviews/{id}', 'BookReviewController@destroy');
});

Route::group(['middleware' => ['auth']], function ($router){
    $router->get('/book', 'BookController@index');
    $router->get('/book/{id}', 'BookController@show');
    $router->post('/book', 'BookController@store');
    $router->put('/book/{id}', 'BookController@update');
    $router->delete('/book/{id}', 'BookController@destroy');
});


//Category
$router->get('/category', 'CategoryController@index');
$router->get('/category/{id}', 'CategoryController@show');
$router->post('/category', 'CategoryController@store');
$router->put('/category/{id}', 'CategoryController@update');
$router->delete('/category/{id}', 'CategoryController@destroy');


