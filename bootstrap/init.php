<?php

// Start session
//use App\Controller\BaseController;
//use App\Controllers;

if(!isset($_SESSION)) session_start();

//Load environment variable

require_once __DIR__.'/../app/config/_env.php';

//require the routes file
require_once __DIR__. '/../app/Routing/routes.php';


 new \App\RouteDispatcher($router);