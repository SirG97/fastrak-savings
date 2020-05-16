<?php


namespace App\controllers;

use Illuminate\Database\Capsule\Manager as Capsule;
use App\classes\CSRFToken;
use App\classes\Random;
use App\classes\Redirect;
use App\classes\Request;
use App\classes\Session;
use App\classes\Validation;
use App\models\Customer;
use App\models\Pin;


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
                        'customer_id' => Random::generateId(16),
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

    public function editcustomer($id){

        $customer_id = $id['customer_id'];
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

    public  function deletecustomer($id){
        $customer_id = $id['customer_id'];

        if(Request::has('post')){
            $request = Request::get('post');

            if(CSRFToken::verifyCSRFToken($request->token)){

                $customer = Customer::where('customer_id', '=', $customer_id)->first();
                $customer->delete();
                Session::add('success', 'Customer deleted successfully');
                Redirect::to('/customers');
            }
//            Session::add('error', 'Customer deletion failed');
//            Redirect::to('/customers');
        }else{
            echo 'request error';
        }

    }
    
    public function searchcustomer($terms){
        //Get the value of the term from the array
        $term = trim($terms['terms']);
        $searchresult = Customer::query()
            ->where('surname', 'LIKE', "%{$term}%")
            ->orWhere('firstname', 'LIKE', "%{$term}%")
            ->orWhere('email', 'LIKE', "%{$term}%")
            ->orWhere('phone', 'LIKE', "%{$term}%")->get();
        if(count($searchresult) > 0){
            echo json_encode(['success' => $searchresult]);
            exit();
        }else{
            echo json_encode(['su' => 'No result found']);
            exit();
        }

    }

    public function contributions(){
        return view('user/contributions');
    }

    public function contribute_form(){
        return view('user/contribute');
    }

    public function contribute(){
        if(Request::has('post')){
            $request = Request::get('post');
            if(CSRFToken::verifyCSRFToken($request->token)){
                //Validation Rules
                $rules = [
                    'phone' => ['required' => true,'maxLength' => 13, 'minLength' => 11, 'number' => true],
                    'pin' => ['required' => true,'minLength' => '12', 'maxLength' => '12', 'number' => true],
                ];

                //Run Validation and return errors
                $validation = new Validation();
                $validation->validate($_POST, $rules);
                if($validation->hasError()){
                    $errors = $validation->getErrorMessages();
                    return view('user/contribute', ['errors' => $errors]);
                }


                $is_registered_customer = Customer::where('phone', '=', $request->phone)->first();

                if($is_registered_customer == null){
                    Session::add('error', 'This number is not registered');
                    return view('user/contribute');
                }

                //Check if user has been logged for fraud in the last 30 mins
                $fraud_status = CustomerController::is_fraudulent($request->phone);

                // Prevent the user from accessing the service for a brief period of time
                if($fraud_status == true){
                    Session::add('error', 'This number has been banned from using this service');
                    return view('user/contribute');
                }


                $is_pin_valid = Pin::find($request->pin);
                if($is_pin_valid == null){

                    //Update Fraud table
                    $fraud_count = CustomerController::update_fraud_count($request->phone);
                    if($fraud_count === true){
                        Session::add('error', 'You have been barred from using this service');
                        return view('user/contribute');
                    }else{
                        $error_msg = 'You have only '. $fraud_count . ' trial(s) remaining';

                        Session::add('error', $error_msg);

                        return view('user/contribute');
                    }


                }else{
                    //Log information and make API call to the bank to fulfill the request
                    var_dump($is_registered_customer);
                    var_dump($is_pin_valid);
                    die('We are good to go');
                }



            }
        }
    }

    private static function is_fraudulent($number){
        $query = "SELECT * FROM fraud WHERE phone = ". $number ." AND TIMESTAMPDIFF(MINUTE, updated_at, CURRENT_TIMESTAMP) < 30 ORDER BY updated_at DESC LIMIT 1";
        $status = Capsule::select($query);
        if(count($status) != 0){
            if($status[0]->fraud_status == 1){
                return true;
            }else{
                return false;
            }
        }
        return false;
    }

    private static function update_fraud_count($number){
        // Update fraud count and return trials remaining and
        $count = Capsule::select("SELECT trials FROM fraud WHERE phone =". $number . " AND TIMESTAMPDIFF(MINUTE, updated_at, CURRENT_TIMESTAMP) < 30 ORDER BY updated_at DESC LIMIT 1");
        if(count($count) != 0 || $count != false){

            $trial =  (int)$count[0]->trials;

            if($trial == 2){
                // Update fraud count and set fraud status to true
                $update_fraud = Capsule::update("UPDATE fraud SET trials = 3, fraud_status = 1 WHERE phone = $number ORDER BY updated_at DESC LIMIT 1");
                if($update_fraud){
                    return true;
                }
            }else{
                $trial += 1;
                // Update trial count
                $update_fraud = Capsule::update("UPDATE fraud SET trials = $trial WHERE phone = $number ORDER BY updated_at DESC LIMIT 1");
                if($update_fraud){
                    return 1;
                }
            }
        }else{
           $log_fraud = Capsule::insert("INSERT INTO fraud (phone, trials, fraud_status) VALUES ('$number', 1, 0)");
           if($log_fraud){
               //Remaining trials before block
               return 2;
           }
        }

    }
}