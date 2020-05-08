<?php

use App\classes\Session;
use App\models\User;
use Philo\Blade\Blade;
use voku\helper\Paginator;
use Carbon\Carbon;
use Illuminate\Database\Capsule\Manager as Capsule;

function view($path, array $data = []){
    // specify the path to the view and cache path
    $view = __DIR__.'/../../resources/views';
    $cache = __DIR__.'/../../bootstrap/cache';
    $blade = new Blade($view, $cache);

    echo $blade->view()->make($path, $data)->render();
}

function make($filename, $data){
    extract($data);
    // Start output buffering
    ob_start();
    // include template
    include(__DIR__. '/../../resources/views/emails/' . $filename . '.php');

    // get content
    $content = ob_get_contents();
    // Erase the output and clear the buffer
    ob_end_clean();

    return $content;
}

function isAuthenticated(){
    return Session::has('SESSION_USER_ID') ? true : false;
}

function user(){
    if(isAuthenticated()){
        return User::findOrFail(Session::has('SESSION_USER_ID'));
    }

    return false;
}

function paginate($num_of_record, $total_record, $table, $object){
    $d = [];

    $pages = new Paginator($num_of_record, 'p');
    $pages->set_total($total_record);

    $data = Capsule::select("SELECT * FROM ". $table . " ". $pages->get_limit());
    $d = $object->transform($data);

    return [$d, $pages->page_links()];
}