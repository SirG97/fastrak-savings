<?php


namespace App\Classes;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database{
    public function __construct(){
        $db = new Capsule();
        $db->addConnection([
            'driver' => 'mysql',
            'host' => 'ec2-52-87-242-220.compute-1.amazonaws.com',
            'database' =>'ononixi1_char',
            'username' => 'ononixi1_giga',
            'password' => 'rrwcscrz1',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => ''
        ]);

        $db->setAsGlobal();
        $db->bootEloquent();
    }
}