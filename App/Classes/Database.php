<?php


namespace App\Classes;

use Illuminate\Database\Capsule\Manager as Capsule;


class Database{
    public function __construct(){
        $db = new Capsule();
        $db->addConnection([
            'driver' => 'mysql',
            'host' => 'db4free.net',
            'database' => 'cls_charity',
            'username' =>  'sarge_charity',
            'password' => 'DB_PASSWORD', 'rrwcscrz1_charity',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => ''
        ]);

        $db->setAsGlobal();
        $db->bootEloquent();
    }
}