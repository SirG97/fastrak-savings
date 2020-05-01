<?php
require_once __DIR__.'/../../vendor/altorouter/altorouter/AltoRouter.php';


$router = new Altorouter();

$router->map('GET', '/', '\App\Controllers\IndexController@show', 'home');

$router->map('GET', '/dashboard', '\App\Controllers\DashboardController@show', 'dashboard');


