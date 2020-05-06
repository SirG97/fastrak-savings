<?php
require_once __DIR__.'/../../vendor/altorouter/altorouter/AltoRouter.php';


$router = new Altorouter();

$router->map('GET', '/', '\App\Controllers\IndexController@show', 'home');

$router->map('GET', '/register', '\App\Controllers\AuthController@showregister', 'show_register');
$router->map('POST', '/register', '\App\Controllers\AuthController@register', 'register_user');

// Authentication and login
$router->map('GET', '/login', '\App\Controllers\AuthController@show', 'login');
$router->map('POST', '/login', '\App\Controllers\AuthController@login', 'auth');
$router->map('GET', '/settings', '\App\Controllers\AuthController@showsettings', 'show_settings');
$router->map('POST', '/settings', '\App\Controllers\AuthController@settings', 'settings');
$router->map('GET', '/logout', '\App\Controllers\AuthController@logout', 'logout');

$router->map('GET', '/dashboard', '\App\Controllers\DashboardController@show', 'dashboard');
$router->map('POST', '/dashboard', '\App\Controllers\DashboardController@store', 'dt');

$router->map('GET', '/customers', '\App\Controllers\CustomerController@show', 'customers');
$router->map('GET', '/customer', '\App\Controllers\CustomerController@showcustomerform', 'customer');
$router->map('POST', '/customer', '\App\Controllers\CustomerController@storecustomer', 'store_customer');

$router->map('GET', '/contributions', '\App\Controllers\CustomerController@contributions', 'contributions');
$router->map('POST', '/contribute', '\App\Controllers\CustomerController@contribute', 'contribute');


