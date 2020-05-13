<?php
require_once __DIR__.'/../../vendor/altorouter/altorouter/AltoRouter.php';


$router = new Altorouter();

$router->map('GET', '/', '\App\Controllers\IndexController@show', 'home');

$router->map('GET', '/register', '\App\Controllers\AuthController@showregister', 'show_register');
$router->map('POST', '/register', '\App\Controllers\AuthController@register', 'register_user');

// Authentication and login
$router->map('GET', '/login', '\App\Controllers\AuthController@show', 'login');
$router->map('POST', '/login', '\App\Controllers\AuthController@login', 'auth');
$router->map('GET', '/logout', '\App\Controllers\AuthController@logout', 'logout');

$router->map('GET', '/dashboard', '\App\Controllers\DashboardController@show', 'dashboard');
$router->map('POST', '/dashboard', '\App\Controllers\DashboardController@store', 'dt');

//Customer
$router->map('GET', '/customers', '\App\Controllers\CustomerController@show', 'customers');

$router->map('GET', '/customer', '\App\Controllers\CustomerController@showcustomerform', 'customer');
$router->map('POST', '/customer', '\App\Controllers\CustomerController@storecustomer', 'store_customer');
$router->map('POST', '/customer/[:customer_id]/edit', '\App\Controllers\CustomerController@editcustomer', 'edit_customer');
$router->map('POST', '/customer/[:customer_id]/delete', '\App\Controllers\CustomerController@deletecustomer', 'delete_customer');
$router->map('GET', '/customer/[:terms]/search', '\App\Controllers\CustomerController@searchcustomer', 'search_customer');


//$router->addMatchTypes(array('cId' => '[a-zA-Z]{2}[0-9](?:_[0-9]++)?'));

//Contributions
$router->map('GET', '/contributions', '\App\Controllers\CustomerController@contributions', 'contributions');
$router->map('POST', '/contribute', '\App\Controllers\CustomerController@contribute', 'contribute');

// Settings
$router->map('GET', '/settings', '\App\Controllers\SettingsController@showSettings', 'show_settings');
$router->map('POST', '/settings', '\App\Controllers\SettngsController@settings', 'settings');

