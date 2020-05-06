<?php


namespace App\controllers;


use App\classes\CSRFToken;
use App\classes\Redirect;
use App\classes\Request;
use App\classes\Session;
use App\classes\Validation;
use App\models\User;

class CustomerController extends BaseController{
    public function show(){
        return view('user/customers');
    }

    public function showcustomerform(){
        return view('user/customer');
    }

    public function storecustomer(){
        if(Request::has('post')){
                $request = Request::get('post');
                if(CSRFToken::verifyCSRFToken($request->token)){

                    $rules = [
                        'email' => ['required' => true, 'maxLength' => 20, 'email' => true, 'unique' =>'users'],
                        'firstname' => ['required' => true, 'maxLength' => 40, 'string' => true],
                        'surname' => ['string' => true, 'maxLength' => 40],
                        'phone' => ['required' => true,'maxLength' => 11, 'minLength' => 11, 'number' => true],
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

    public function contributions(){
        return view('user/contributions');
    }

    public function contribute(){

    }
}