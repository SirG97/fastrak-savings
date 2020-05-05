<?php


namespace App\controllers;

use App\classes\CSRFToken;
use App\classes\Request;
use App\classes\Validation;

class DashboardController extends BaseController{
    public function show(){

        return view('user/dashboard');
    }


    public function get(){
        $data = Request::old('post', 'name');
        $request = Request::get('post');

    }

    public function store(){

        if(Request::has('post')){
            $request = Request::get('post');


            if(CSRFToken::verifyCSRFToken($request->token)){
                var_dump('hia chim oo');

                $rules = [
                    'surname' => ['required' => true, 'maxLength' => 7, 'string' => true, 'unique' =>'users']
                ];
                $validation = new Validation();
                $validation->validate($_POST, $rules);
                if($validation->hasError()){
                    var_dump($validation->getErrorMessages());
                    exit();
                }

                return view('user/dashboard', compact('error'));

            }

            throw new \Exception('Token mismatch');



        }


    }


}