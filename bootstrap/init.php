<?php

// Start session

if(!isset($_SESSION)) session_start();

//Load environment variable

require_once __DIR__.'/../app/config/_env.php';