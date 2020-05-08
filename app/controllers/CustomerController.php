<?php


namespace App\controllers;


use App\classes\CSRFToken;
use App\classes\Redirect;
use App\classes\Request;
use App\classes\Session;
use App\classes\Validation;
use App\models\Customer;


class CustomerController extends BaseController{
    public $table_name = 'customers';
    public $customers;
    public $links;

    public function __construct(){
        $total = Customer::all()->count();
//        $customers = Customer::all();
        $object = new Customer();

        list($this->customers, $this->links) = paginate(20, $total, $this->table_name, $object);
    }

    public function show(){

        return view('user/customers', ['customers' => $this->customers, 'links' => $this->links]);
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

                    Session::add('success', 'New customer created successfully');

                    Redirect::to('/customers');
                    exit();

                }

                Redirect::to('/customer');
            }
    }

    public function editcustomer($params){

        $customer_id = $params['customer_id'];
        if(Request::has('post')){
            $request = Request::get('post');
            if(CSRFToken::verifyCSRFToken($request->token, false)){

                $rules = [
                    'email' => ['required' => true, 'maxLength' => 30, 'email' => true, 'unique_edit' => 'customers|' .$customer_id .'|customer_id'],
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
                    header('HTTP 1.1 422 Unprocessable Entity', true, 422);
                    echo json_encode($errors);
                    exit();
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

                Customer::where('customer_id', $customer_id)->update($details);
                echo json_encode(['success' => 'Customer details updated successfully']);
                exit();

            }else{
                echo 'token error';
            }

            //Redirect::to('/customer');
        }else{
            echo 'request error';
        }

    }

    public function contributions(){
        return view('user/contributions');
    }

    public function contribute(){

    }
}