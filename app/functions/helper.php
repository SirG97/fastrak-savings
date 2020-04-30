<?php
use Philo\Blade\Blade;
function view($path, array $data = []){
    // specify the path to the view and cache path
    $view = __DIR__.'/../../resources/views';
    $cache = __DIR__.'/../../bootstrap/cache';
    $blade = new Blade($view, $cache);

    echo $blade->view()->make($path, $data)->render();
}