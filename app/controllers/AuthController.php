<?php


namespace App\controllers;


use App\classes\CSRFToken;
use App\classes\Redirect;
use App\classes\Request;
use App\classes\Session;
use App\classes\Validation;
use App\models\User;


class AuthController{
    public function show(){

        return view('user/login', ['success' => '','errors' => []]);

    }

    public function login(){
        if(Request::has('post')){
            $request = Request::get('post');
            if(CSRFToken::verifyCSRFToken($request->token)){

                $rules = [
                    'email' => ['required' => true, 'email' => true],
                    'password' => ['required' => true,'maxLength' => 40]

                ];
                $validation = new Validation();
                $validation->validate($_POST, $rules);
                if($validation->hasError()){
                    $errors = $validation->getErrorMessages();
                    return view('user/login', ['errors' => $errors]);
                }

                $user = User::where('email', $request->email)->first();
                 if($user){
                     if(!password_verify($request->password, $user->password)){
                        Session::add('error', 'incorrect password');
                        return view('user/login');
                     }else{
                         Session::add('SESSION_USER_ID', $user->userid);
                         Session::add('SESSION_USERNAME', $user->firstname);

                         Redirect::to('/dashboard');
                     }
                 }else{
                     Session::add('error', 'username not found');
                     return view('user/login');
                 }

                Session::add('success', 'user created successfully');

                Redirect::to('/dashboard');

            }

            throw new \Exception('Token mismatch');
        }

    }

    public function showRegister(){

        return view('user/register', ['success' => '','errors' => []]);

    }

    public function register(){
        if(Request::has('post')){
            $request = Request::get('post');
            if(CSRFToken::verifyCSRFToken($request->token)){

                $rules = [
                    'email' => ['required' => true, 'maxLength' => 20, 'email' => true, 'unique' =>'users'],
                    'firstname' => ['required' => true, 'maxLength' => 40, 'string' => true],
                    'surname' => ['string' => true, 'maxLength' => 40],
                    'password' => ['required' => true,'maxLength' => 40, 'minLength' => 6],
                    'cpassword' => ['confirmed' => $request->password]
                ];
                $validation = new Validation();
                $validation->validate($_POST, $rules);
                if($validation->hasError()){
                    $errors = $validation->getErrorMessages();
                    return view('user/register', ['errors' => $errors]);
                }

                //Add the user
                User::create([
                    'userid' => base64_encode(openssl_random_pseudo_bytes(16)),
                    'surname' => $request->surname,
                    'firstname' => $request->firstname,
                    'email' => $request->email,
                    'password' => password_hash($request->password, PASSWORD_BCRYPT)
                ]);

                Request::refresh();

                Session::add('success', 'user created successfully');

                Redirect::to('/login');

            }

            throw new \Exception('Token mismatch');
        }

    }
}