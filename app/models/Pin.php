<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Pin extends Model
{
    //
    protected $table = 'pins';

    //change my primary key from id to pin
    protected $primaryKey = 'pin';
    //Tell laravel that the primary key is not an integer
    public $incrementing = false;


    public function transform($data){
        $pins = [];
        foreach ($data as $item){
            array_push($pins,[
                'serial' => $item->serial,
                'batch_no' => $item->batch_no,
                'pin' => $item->pin,
                'amount' => $item->amount,
                'user_id' => $item->user_id,
                'bank' => $item->bank,
                'account_sent_to' => $item->account_sent_to,
                'status' => $item->status,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'deleted_at' => $item->deleted_at,
            ]);

        }
        return $pins;
    }

}