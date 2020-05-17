<?php


namespace App\models;

use Illuminate\Database\Eloquent\Model;



class Contribution extends Model{

    public $timestamps = true;

    protected $fillable = ['contribution_id','pin', 'phone', 'ledger_bal', 'available_bal', 'points'];

    public function transform($data){
        $contributions = [];
        foreach ($data as $item){
            array_push($contributions,[
                'contribution_id' => $item->contribution,
                'phone' => $item->phone,
                'pin' => $item->pin,
                'ledger_bal' => $item->ledger,
                'available_bal' => $item->available_bal,
                'points' => $item->points,


            ]);

        }
        return $contributions;
    }
}