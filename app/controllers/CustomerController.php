<?php


namespace App\controllers;


class CustomerController extends BaseController{
    public function show(){
        return view('user/customers');
    }

    public function showcustomerform(){
        return view('user/customer');
    }

    public function storecustomer(){

    }

    public function contributions(){
        return view('user/contributions');
    }

    public function contribute(){

    }
}