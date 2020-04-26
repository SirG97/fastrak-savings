<?php

// Start session

if(!isset($_SESSION)) start_session();

//Load environment variable

require_once __DIR__.'/../app/config/_env.php';