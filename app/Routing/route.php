<?php
require_once __DIR__.'/../../vendor/altorouter/altorouter/AltoRouter.php';

$router = new Altorouter();

$router->map('GET', '/', '', 'home');

$match = $router->match();
 if($match){
    require_once __DIR__. '/../controllers/BaseController.php';
    require_once __DIR__. '/../controllers/IndexController.php';
    $index = new \App\Controllers\IndexController();
    $index->show();
 }
