<?php


namespace App\controllers;


class DashboardController extends BaseController{
    public function show(){
        return view('user/dashboard');
    }
}