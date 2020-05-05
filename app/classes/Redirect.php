<?php


namespace App\classes;


class Redirect{
    /**
     * @param $url
     */
    public static function to($url){
        header("Location:{$url}");
    }

    /**
     *
     */
    public static function back(){
        $uri = $_SERVER['REQUEST_URI'];
        header("Location:{$uri}");
    }


}