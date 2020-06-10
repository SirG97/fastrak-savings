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
$router->map('GET', '/dashboard/chart', '\App\Controllers\DashboardController@chart_info', 'chart');

//Customer Routes
$router->map('GET', '/customers', '\App\Controllers\CustomerController@show', 'customers');

$router->map('GET', '/customer', '\App\Controllers\CustomerController@showcustomerform', 'customer');
$router->map('POST', '/customer', '\App\Controllers\CustomerController@storecustomer', 'store_customer');
$router->map('GET', '/customer/[:customer_id]', '\App\Controllers\CustomerController@getcustomer', 'get_customer');
//$router->map('GET', '/customer/[:contribution_id]', '\App\Controllers\CustomerController@getcontribution', 'get_contribution');
$router->map('POST', '/customer/[:customer_id]/edit', '\App\Controllers\CustomerController@editcustomer', 'edit_customer');
$router->map('POST', '/customer/[:customer_id]/delete', '\App\Controllers\CustomerController@deletecustomer', 'delete_customer');
$router->map('GET', '/customer/[:terms]/search', '\App\Controllers\CustomerController@searchcustomer', 'search_customer');

//Fastrak Pin Route
$router->map('GET', '/pins', '\App\Controllers\PinController@index', 'pins');
$router->map('GET', '/newpins', '\App\Controllers\PinController@generate_form', 'generate_pins_form');
$router->map('POST', '/pins/new', '\App\Controllers\PinController@generate', 'generate_pins');
$router->map('GET', '/pins/live', '\App\Controllers\PinController@live', 'get_live_pins');
$router->map('GET', '/pins/used', '\App\Controllers\PinController@used', 'get_used_pins');
$router->map('GET', '/pins/pending', '\App\Controllers\PinController@pending', 'get_pending_pins');

//$router->addMatchTypes(array('cId' => '[a-zA-Z]{2}[0-9](?:_[0-9]++)?'));

//Contributions
$router->map('GET', '/contributions', '\App\Controllers\ContributionController@get_all', 'contributions');
$router->map('GET', '/contribute', '\App\Controllers\ContributionController@contribute_form', 'contribute_form');
$router->map('POST', '/contribute', '\App\Controllers\ContributionController@contribute', 'contribute');
$router->map('GET', '/contributions/[:terms]/search', '\App\Controllers\ContributionController@search_contribution', 'search_contribution');
$router->map('POST', '/ussd', '\App\Controllers\ContributionController@ussd', 'ussd');

// Settings
$router->map('GET', '/settings', '\App\Controllers\SettingsController@showSettings', 'show_settings');
$router->map('POST', '/settings', '\App\Controllers\SettngsController@settings', 'settings');

