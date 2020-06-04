<?php

namespace App\Models;

use App\Classes\Encryption;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pin extends Model
{
    use SoftDeletes;

    public $timestamps = true;
    //change my primary key from id to pin
    protected $primaryKey = 'pin';
    //Tell laravel that the primary key is not an integer
    public $incrementing = false;
    protected $fillable = ['serial', 'pin', 'batch_no', 'amount'];


    public function transform($data){
        $pins = [];
        foreach ($data as $item){
            array_push($pins,[
                'serial' => $item->serial,
                'batch_no' => $item->batch_no,
                'pin' => $this->decryptPins($item->pin),
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

    private function decryptPins($pin){
        $encryption = new Encryption();
        $pin = $encryption->decrypt($pin);
        return $pin;
    }

}