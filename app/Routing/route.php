<?php
require_once __DIR__.'/../../vendor/altorouter/altorouter/AltoRouter.php';

$router = new Altorouter();

$router->map('GET', '/about', '', 'about us');

$match = $router->match();

var_dump($match);