<?php
require_once __DIR__.'/../../vendor/altorouter/altorouter/AltoRouter.php';


$router = new Altorouter();

$router->map('GET', '/', '\App\Controllers\IndexController@show', 'home');

// Authentication and login
$router->map('GET', '/login', '\App\Controllers\AuthController@show', 'login');
$router->map('POST', '/login', '\App\Controllers\AuthController@login', 'auth');
$router->map('GET', '/register', '\App\Controllers\AuthController@showregister', 'show_register');
$router->map('POST', '/register', '\App\Controllers\AuthController@create', 'regsiter_user');

$router->map('GET', '/dashboard', '\App\Controllers\DashboardController@show', 'dashboard');
$router->map('POST', '/dashboard', '\App\Controllers\DashboardController@store', 'dt');


