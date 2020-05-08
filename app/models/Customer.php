<?php


namespace App\models;


use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Customer extends Model{
    public $timestamps = true;
    protected $fillable = ['customer_id', 'surname', 'firstname', 'email', 'phone', 'address', 'city', 'state', 'amount'];

    public function transform($data){
        $customers = [];
        foreach ($data as $item){
            array_push($customers,[
                'status' => $item->status,
                'customer_id' => $item->customer_id,
                'surname' => $item->surname,
                'firstname' => $item->firstname,
                'email' => $item->email,
                'phone' => $item->phone,
                'address' => $item->address,
                'city' => $item->city,
                'state' => $item->state,
                'amount' => $item->amount,
            ]);

        }
        return $customers;
    }
} 