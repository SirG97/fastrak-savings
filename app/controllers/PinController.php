<?php

namespace App\controllers;

use App\classes\CSRFToken;
use App\classes\Random;
use App\classes\Redirect;
use App\classes\Request;
use App\classes\Session;
use App\classes\Validation;
use App\models\Pins;


class PinController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {

         $pins = Pins::all();

        //$pins =  DB::select("SELECT * FROM pins LIMIT 10");
        return view('home');
        //echo date("Y:m:d H:i:s");


    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {
        //
        return View::make('generate');
    }

    /**
     * Store a newly created resource in storage.
     *
     */

    public function getLastInserted(){
        $usedPinsCount = \App\Pins::get()->count();
        if($usedPinsCount > 0){
            $usedPins = \App\Pins::limit(1)->latest()->orderBy('id', 'desc')->get();
            return $usedPins[0]['id'];
        }else{
            $empty = 32398439;
            return $empty;
        }

    }

    public function appendSerialPrefix($last){
        if($last < 10){
            return 'FSTK000000000' . $last;
        }elseif($last < 100){
            return 'FSTK00000000' . $last;
        }elseif($last < 1000){
            return 'FSTK0000000' . $last;
        }elseif($last < 10000){
            return 'FSTK000000' . $last;
        }elseif($last < 100000){
            return 'FSTK00000' . $last;
        }elseif($last < 1000000){
            return 'FSTK0000' . $last;
        }elseif($last < 10000000){
            return 'FSTK000' . $last;
        }elseif($last < 100000000){
            return 'FSTK00' . $last;
        }elseif($last < 1000000000){
            return 'FSTK0' . $last;
        }else{
            return 'FSTK' . $last;
        }
    }

    public function store(Request $request){
        //
        $pin = new \App\Pins;
        $now = Carbon::now()->toDateTimeString();
        $amt5H = $request->get('amt500');
        $qty5H = $request->get('qty500');

        $amt1k = $request->get('amt1000');
        $qty1k = $request->get('qty1000');

        $amt2k = $request->get('amt2000');
        $qty2k = $request->get('qty2000');

        $amt3k = $request->get('amt3000');
        $qty3k = $request->get('qty3000');

        $amt5k = $request->get('amt5000');
        $qty5k = $request->get('qty5000');


        $dataToInsert = array();
        $batchNo = Random::generateString(8, 'FASTRAK0123456789');
        $lastInserted = $this->getLastInserted();
        $lastInserted += 1;


        //Random::generateString(10, 'FASTRAK0123456789')
        //for #500
        for($i = 0; $i < $qty5H; $i++){
            $dataToInsert[] = array(
                'serial' => $this->appendSerialPrefix($lastInserted),
                'pin' => Random::generateString(12, '0123456789'),
                'amount' => $amt5H,
                'batch_no' => $batchNo,
                'created_at' => $now,
                'updated_at' => $now

            );
            $lastInserted++;
        }
        // for #1000
        for($i = 0; $i < $qty1k; $i++){
            $dataToInsert[] = array(
                'serial' => $this->appendSerialPrefix($lastInserted),
                'pin' => Random::generateString(12, '0123456789'),
                'amount' => $amt1k,
                'batch_no' => $batchNo,
                'created_at' => $now,
                'updated_at' => $now

            );
            $lastInserted++;
        }

        // for #1000
        for($i = 0; $i < $qty2k; $i++){
            $dataToInsert[] = array(
                'serial' => $this->appendSerialPrefix($lastInserted),
                'pin' => Random::generateString(12, '0123456789'),
                'amount' => $amt2k,
                'batch_no' => $batchNo,
                'created_at' => $now,
                'updated_at' => $now

            );
            $lastInserted++;
        }

        // for #1000
        for($i = 0; $i < $qty3k; $i++){
            $dataToInsert[] = array(
                'serial' => $this->appendSerialPrefix($lastInserted),
                'pin' => Random::generateString(12, '0123456789'),
                'amount' => $amt3k,
                'batch_no' => $batchNo,
                'created_at' => $now,
                'updated_at' => $now

            );
            $lastInserted++;
        }

        // for #1000
        for($i = 0; $i < $qty5k; $i++){
            $dataToInsert[] = array(
                'serial' => $this->appendSerialPrefix($lastInserted),
                'pin' => Random::generateString(12, '0123456789'),
                'amount' => $amt5k,
                'batch_no' => $batchNo,
                'created_at' => $now,
                'updated_at' => $now

            );
            $lastInserted++;
        }


        DB::table('pins')->insert($dataToInsert);
        return redirect('home')->with('success', 'Pins Generated Successfully');

    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

    }

    public function setLivePin(Request $request){
        $setFrom = 'generated';
        $setTo = 'live';
        $sql = "update pins set status= $setFrom WHERE status = $setTo";
        $setlive = DB::statement('UPDATE pins SET `status` = "live" WHERE `status` ="generated"');
        return redirect('live')->with('setpin', 'Pins set to LIVE Successfully');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id

     */
    public function destroy($id)
    {
        //
    }
}