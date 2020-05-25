<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Contribution extends Model{

    public $timestamps = true;

    protected $fillable = ['contribution_id','pin', 'phone', 'ledger_bal', 'available_bal', 'points'];

    public function transform($data){
        $contributions = [];
        foreach ($data as $item){
            array_push($contributions,[
                'contribution_id' => $item->contribution_id,
                'phone' => $item->phone,
                'pin' => $item->pin,
                'ledger_bal' => $item->ledger_bal,
                'available_bal' => $item->available_bal,
                'points' => $item->points,
                'created_at' => $item->created_at


            ]);

        }
        return $contributions;
    }
}