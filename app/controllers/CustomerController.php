<?php


namespace App\controllers;


use App\classes\CSRFToken;
use App\classes\Redirect;
use App\classes\Request;
use App\classes\Session;
use App\classes\Validation;
use App\models\Customer;


class CustomerController extends BaseController{
    public function show(){
        $customers = Customer::all();
        return view('user/customers', compact('customers'));
    }

    public function showcustomerform(){
        return view('user/customer');
    }

    public function storecustomer(){
        if(Request::has('post')){
                $request = Request::get('post');
                if(CSRFToken::verifyCSRFToken($request->token)){

                    $rules = [
                        'email' => ['required' => true, 'maxLength' => 30, 'email' => true, 'unique' =>'customers'],
                        'firstname' => ['required' => true, 'maxLength' => 40, 'string' => true],
                        'surname' => ['string' => true, 'maxLength' => 40],
                        'phone' => ['required' => true,'maxLength' => 13, 'minLength' => 11, 'number' => true],
                        'city' => ['required' => true, 'maxLength' => '50', 'string' => true],
                        'state' => ['required' => true, 'maxLength' => '50', 'string' => true],
                        'address' => ['required' => true, 'maxLength' => '150'],
                        'amount' => ['required' => true,  'number' => true]
                    ];
                    $validation = new Validation();
                    $validation->validate($_POST, $rules);
                    if($validation->hasError()){
                        $errors = $validation->getErrorMessages();
                        return view('user/customer', ['errors' => $errors]);
                    }

                    //Add the user
                    $details = [
                        'customer_id' => base64_encode(openssl_random_pseudo_bytes(16)),
                        'surname' => $request->surname,
                        'firstname' => $request->firstname,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'address' => $request->address,
                        'city' => $request->city,
                        'state' => $request->state,
                        'amount' => $request->amount,

                    ];

                    Customer::create($details);

                    Request::refresh();

                    Session::add('success', 'user created successfully');

                    Redirect::to('/customers');
                    exit();

                }

                Redirect::to('/customer');
            }
    }

    public function editcustomer($id){

    }

    public function contributions(){
        return view('user/contributions');
    }

    public function contribute(){

    }
}