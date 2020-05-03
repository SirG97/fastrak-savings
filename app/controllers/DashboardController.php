<?php


namespace App\controllers;

use App\classes\Request;
use App\Classes\Session;

class DashboardController extends BaseController{
    public function show(){
        Session::add('admin', 'you are welcome');

        if(Session::has('admin')){
            $msg = Session::get('admin');
        }else{
            $msg = 'Not defined';
        }
        return view('user/dashboard', ['admin' => $msg]);
    }


    public function get(){
        $data = Request::old('post', 'name');
        $request = Request::get('post');

    }


}