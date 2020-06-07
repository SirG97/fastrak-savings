<?php


namespace App\Controllers;

use App\Classes\CSRFToken;
use App\Classes\Request;
use App\Classes\Random;
use App\Classes\Redirect;
use App\Models\Customer;
use App\Models\Pin;
use App\Models\Contribution;
use Illuminate\Database\Capsule\Manager as Capsule;

class DashboardController extends BaseController{
    public function show(){
        // TODO: Total customer
        $total_customer = Customer::all()->count();

        // Total saved
        $total_saved_ledger = "SELECT SUM(ledger_bal) total_saved FROM contributions";
        $total_ledger = Capsule::select($total_saved_ledger);
        $total_saved = $total_ledger[0]->total_saved;

        // Total revenue generated

        $total_saved_available = "SELECT SUM(available_bal) total FROM contributions";
        $total_available = Capsule::select($total_saved_available);
        $total_revenue = $total_ledger[0]->total_saved - $total_available[0]->total;

        //  Total Total number of pins
        $total_pins = Pin::all()->count();

        //  Number generated vs used for 10 days period -bar or line chart
        $live_pins = "SELECT created_at, count(pin) as generated_pin 
                            FROM pins 
                            WHERE status = 'live' 
                            AND created_at >= DATE_SUB(CURDATE(),INTERVAL 7 DAY)
                            GROUP BY created_at;";
        $get_live_pins = Capsule::select($live_pins);
        $used_pins = "SELECT created_at, count(pin) as generated_pin 
                            FROM pins 
                            WHERE status = 'used' 
                            AND created_at >= DATE_SUB(CURDATE(),INTERVAL 7 DAY)
                            GROUP BY created_at;";
        $get_used_pins = Capsule::select($used_pins);

        $get_daily_contribution = "SELECT updated_at, count(*) as daily_contribution 
                            FROM contributions 
                            WHERE updated_at >= DATE_SUB(CURDATE(),INTERVAL 7 DAY)
                            GROUP BY updated_at;";
        $daily_contribution = Capsule::select($get_daily_contribution);

        // TODO: Doughnut pie of channel used
        return view('user/dashboard',['total_customer' => $total_customer,
                                            'total_saved' => number_format($total_saved, 2,'.', ','),
                                            'total_revenue' => number_format($total_revenue, 2,'.', ','),
                                            'total_pins' => $total_pins,
                                            'live_pins' => $get_live_pins,
                                            'used_pins' => $get_used_pins,
                                            'daily_contribution' => $daily_contribution ]);
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