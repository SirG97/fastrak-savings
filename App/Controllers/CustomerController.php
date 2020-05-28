<?php


namespace App\Controllers;


use Illuminate\Database\Capsule\Manager as Capsule;
use App\Classes\CSRFToken;
use App\Classes\Random;
use App\Classes\Redirect;
use App\Classes\Request;
use App\Classes\Session;
use App\Classes\Validation;
use App\Models\Customer;
use App\Models\Pin;
use App\Models\Contribution;

class CustomerController extends BaseController{
    public $table_name = 'customers';
    public $customers;
    public $links;

//    public function __construct(){
//        $total = Customer::all()->count();
////        $customers = Customer::all();
//        $object = new Customer();
//
//        list($this->customers, $this->links) = paginate(20, $total, $this->table_name, $object);
//    }

    public function show(){
        $total = Customer::all()->count();
        $object = new Customer();

        list($customers, $links) = paginate(20, $total, $this->table_name, $object);
        return view('user/customers', ['customers' => $customers, 'links' => $links]);
    }

    public function getcustomer($id){
        $customer_id = $id['customer_id'];

        $customer = Customer::where('customer_id', $customer_id)->first();

        $total = Contribution::where('phone', $customer->phone)->count();
        $object = new Contribution();
        $filter = ['phone' => $customer->phone];
        list($contributions, $links) = paginate(20,$total,'contributions', $object, $filter);

        $total_donation = 0;
        $total_available = 0;

        $all_contribution = Contribution::where('phone', $customer->phone)->get();
        for($i = 0; $i < count($all_contribution); $i++){
            $total_donation = $total_donation + (int)$all_contribution[$i]->ledger_bal;
            $total_available = $total_available + (int)$all_contribution[$i]->available_bal;
        }

        $maintenance = $total_donation - $total_available;

        return view('user/customerdetails', ['customer' =>$customer,
                                            'links' => $links,
                                            'contributions' => $contributions,
                                            'total_donation' => $total_donation,
                                            'total_available' => $total_available,
                                            'maintenance' => $maintenance]);
    }

    public function getcontribution($id){
        $contribution_id = $id['contribution_id'];
        return view('user/customercontributions');
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
                        'phone' => ['required' => true,'maxLength' => 14, 'minLength' => 11, 'number' => true, 'unique' => 'customers'],
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
                    'phone' => ['required' => true,'maxLength' => 14, 'minLength' => 11],
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
            echo json_encode(['success' => 'No result found']);
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
                    'phone' => ['required' => true,'maxLength' => 14, 'minLength' => 11 ],
                    'pin' => ['required' => true,'minLength' => 12, 'maxLength' => 12],
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
                    $last_contribution = Contribution::where('phone', $request->phone)->latest('id')->first();
                    $pin_amount = (int)$is_pin_valid->amount;
                    $daily_amount = (int)$is_registered_customer->amount;

                    $points = $pin_amount / $daily_amount;

                    if($last_contribution ==  null){
                        if($points <= 31.0){
                            Contribution::create([
                                'contribution_id' => Random::generateId(16),
                                'phone' => $request->phone,
                                'pin' => $request->pin,
                                'ledger_bal' => $pin_amount,
                                'available_bal' => $pin_amount,
                                'points' => $points,
                            ]);
                        }else {
                            $first_store = array();
                            while($points > 0){
                                //die('Remaining points is ' . $remaining_points);
                                if($points > 31.0){
                                    $ledger_bal = 31 * $daily_amount;
                                    $available_bal = (31 * $daily_amount) - $daily_amount;
                                    $cid = Random::generateId(16);
                                    $first_store[] = array(
                                        'contribution_id' => $cid,
                                        'phone' => $request->phone,
                                        'pin' => $request->pin,
                                        'ledger_bal' =>  $ledger_bal,
                                        'available_bal' =>  $available_bal,
                                        'points' => 31.0,
                                    );
                                    $points = $points - 31.0;
                                }else{

                                    $remaining_points = $points % 31;
                                    $remaining_bal = $remaining_points * $daily_amount;
                                    $cid = Random::generateId(16);
                                    $first_store[] = array(
                                        'contribution_id' => $cid,
                                        'phone' => $request->phone,
                                        'pin' => $request->pin,
                                        'ledger_bal' =>  $remaining_bal,
                                        'available_bal' =>  $remaining_bal,
                                        'points' => $remaining_points,
                                    );
                                    $points = 0;
                                }
                            }
                            Contribution::insert($first_store);
                        }
                        //Send info to bank await confirmation

                        Session::add('success', 'Contribution logged successfully');
                        return view('user/contribute');
                    }else{
                        $accumulator = $points + $last_contribution->points;
                        if($accumulator < 31.0){
                            Contribution::create([
                                'contribution_id' => Random::generateId(16),
                                'phone' => $request->phone,
                                'pin' => $request->pin,
                                'ledger_bal' => $pin_amount,
                                'available_bal' => $pin_amount,
                                'points' => $accumulator,
                            ]);
                            Session::add('success', 'Contribution logged successfully');
                            return view('user/contribute');
                        }elseif($accumulator == 31.0){
                            Contribution::create([
                                'contribution_id' => Random::generateId(16),
                                'phone' => $request->phone,
                                'pin' => $request->pin,
                                'ledger_bal' => $pin_amount,
                                'available_bal' => $pin_amount - $daily_amount,
                                'points' => $accumulator,
                            ]);
                            Session::add('success', 'Contribution logged successfully. Cycle completed');
                            return view('user/contribute');
                        }elseif($accumulator > 31.0){
                            $rem_points_to_complete_last_contribution = 31.0 - $last_contribution->points;
                            $rem_to_complete_last_amount = $rem_points_to_complete_last_contribution * $daily_amount;

                            if($rem_points_to_complete_last_contribution == 0 ){

                                if($points <= 31.0){
                                    Contribution::create([
                                        'contribution_id' => Random::generateId(16),
                                        'phone' => $request->phone,
                                        'pin' => $request->pin,
                                        'ledger_bal' => $pin_amount,
                                        'available_bal' => $pin_amount,
                                        'points' => $points,
                                    ]);
                                }else {
                                    $first_store = array();
                                    while($points > 0){
                                        //die('Remaining points is ' . $remaining_points);
                                        if($points > 31.0){
                                            $ledger_bal = 31 * $daily_amount;
                                            $available_bal = (31 * $daily_amount) - $daily_amount;
                                            $cid = Random::generateId(16);
                                            $first_store[] = array(
                                                'contribution_id' => $cid,
                                                'phone' => $request->phone,
                                                'pin' => $request->pin,
                                                'ledger_bal' =>  $ledger_bal,
                                                'available_bal' =>  $available_bal,
                                                'points' => 31.0,
                                            );
                                            $points = $points - 31.0;
                                        }else{

                                            $remaining_points = $points;
                                            $remaining_bal = $remaining_points * $daily_amount;
                                            $cid = Random::generateId(16);
                                            $first_store[] = array(
                                                'contribution_id' => $cid,
                                                'phone' => $request->phone,
                                                'pin' => $request->pin,
                                                'ledger_bal' =>  $remaining_bal,
                                                'available_bal' =>  $remaining_bal,
                                                'points' => $remaining_points,
                                            );
                                            $points = 0;
                                        }
                                    }

                                    Contribution::insert($first_store);
                                }

                                Session::add('success', 'Contribution logged successfully.');
                                return view('user/contribute');
                            }elseif($rem_points_to_complete_last_contribution > 0  and $points <= 31.0){
                                $remainder_to_store = array();
                                $remainder_to_store[] = array(
                                    'contribution_id' => Random::generateId(16),
                                    'phone' => $request->phone,
                                    'pin' => $request->pin,
                                    'ledger_bal' =>  $rem_to_complete_last_amount,
                                    'available_bal' =>   $rem_to_complete_last_amount - $daily_amount,
                                    'points' => $rem_points_to_complete_last_contribution + $last_contribution->points,
                                    );

                                // Minus the remaining amount in
                                $remaining_points = $points - $rem_points_to_complete_last_contribution;
                                $remaining_amount = $pin_amount - $rem_to_complete_last_amount;

                                        $cid = Random::generateId(16);
                                        $remainder_to_store[] = array(
                                            'contribution_id' => $cid,
                                            'phone' => $request->phone,
                                            'pin' => $request->pin,
                                            'ledger_bal' =>  $remaining_amount,
                                            'available_bal' =>  $remaining_amount,
                                            'points' => $remaining_points,
                                        );

                                Contribution::insert($remainder_to_store);

                                Session::add('success', 'Contribution logged successfully.');
                                return view('user/contribute');
                            }elseif($rem_points_to_complete_last_contribution > 0  and $points > 31.0){
                                Contribution::create([
                                    'contribution_id' => Random::generateId(16),
                                    'phone' => $request->phone,
                                    'pin' => $request->pin,
                                    'ledger_bal' =>  $rem_to_complete_last_amount,
                                    'available_bal' =>   $rem_to_complete_last_amount - $daily_amount,
                                    'points' => $rem_points_to_complete_last_contribution + $last_contribution->points,
                                ]);
                                // Run a for loop through the remaining amount in case it is more than one cycle
                                $remaining_points = $points - $rem_points_to_complete_last_contribution;
                                $remaining_amount = $pin_amount - $rem_to_complete_last_amount;

                                $remainder_to_store = array();
                                while($remaining_points > 0){

                                    if($remaining_points > 31.0){

                                        $ledger_bal = 31 * $daily_amount;
                                        $available_bal = (31 * $daily_amount) - $daily_amount;
                                        $cid = Random::generateId(16);
                                        $remainder_to_store[] = array(
                                            'contribution_id' => $cid,
                                            'phone' => $request->phone,
                                            'pin' => $request->pin,
                                            'ledger_bal' =>  $ledger_bal,
                                            'available_bal' =>  $available_bal,
                                            'points' => 31.0,
                                        );
                                        $remaining_points = $remaining_points - 31.0;

                                    }else{

                                        $remaining_bal = $remaining_points * $daily_amount;
                                        $cid = Random::generateId(16);
                                        $remainder_to_store[] = array(
                                            'contribution_id' => $cid,
                                            'phone' => $request->phone,
                                            'pin' => $request->pin,
                                            'ledger_bal' =>  $remaining_bal,
                                            'available_bal' =>  $remaining_bal,
                                            'points' => $remaining_points,
                                        );
//                                        echo 'Remaining balance is ' . $remaining_bal;
//                                        die('Remaining points is ' . $remaining_points);
                                        $remaining_points = 0;
                                    }
                                }

                                Contribution::insert($remainder_to_store);

                                Session::add('success', 'Contribution logged successfully.');
                                return view('user/contribute');
                            }

                        }
                    }
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

    public function ussd(){
        $sessionId   = $_POST["sessionId"];
        $serviceCode = $_POST["serviceCode"];
        $phoneNumber = $_POST["phoneNumber"];
        $text        = $_POST["text"];
        $level       = explode("*", $text);
        header('Content-type: text/plain');
        //Check if number is registered
        $is_registered_customer = Customer::where('phone', '=', $phoneNumber)->first();
        if($is_registered_customer == null){
            $response = 'END This number is not registered'. $phoneNumber;
            echo $response;
            exit;
        }
        // Check if number has been logged for fraud for less than 30mins
        $fraud_status = CustomerController::is_fraudulent($phoneNumber);
        if($fraud_status == true){
            $response = 'END This number has been banned from using this service';
            echo $response;
            exit;
        }

        if($text == ''){
            $response = 'CON Please enter your pin';
            echo $response;
            exit;
        }else{
            //The first item in the array should be the pin
            $pin = $level[0];
            $is_pin_valid = Pin::find($pin);
            if($is_pin_valid == null){
                $fraud_count = CustomerController::update_fraud_count($phoneNumber);
                // If fraud count returns true, it means this douche bag has tried an invalid pin up to 3 times
                if($fraud_count === true){
                    $response = 'END You have been barred from using this service';
                    echo $response;
                    exit;
                }else{
                    $response = 'You have only '. $fraud_count . ' trial(s) remaining';
                    echo $response;
                    exit;
                }
            }else{
                $response = 'CON You\'re about to deposit '. $is_pin_valid->amount . 'in your savings.';
                $response .= "1. Proceed\n";
                $response .= "2. Cancel\n";
                echo $response;
                exit;
            }
        }

    }
}