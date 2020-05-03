<?php

namespace App\Controllers;
use App\Classes\Mail;

class IndexController extends BaseController{
    public function show(){
        echo 'This is our home page <br>';
        $data = [
            'to' => 'omesuchinedu@gmail.com',
            'subject' => 'Welcome bro, You don make am',
            'view' => 'welcome',
            'name' => 'Badoo sneh',
            'body' => 'testing email stuff'
        ];
        $mail = new Mail;
//        if($mail->send($data)){
//            echo 'Mail Sent successfully<br>';
//        }else{
//            echo 'This mail shit is fucked up';
//        }
    }
}