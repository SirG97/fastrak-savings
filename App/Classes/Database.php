<?php


namespace App\Classes;

use Illuminate\Database\Capsule\Manager as Capsule;


class Database{
    public function __construct(){
        $db = new Capsule();
        $db->addConnection([
            'driver' => getenv('DB_DRIVER' , 'mysql'),
            'host' => getenv('DB_HOST' ,'db4free.net'),
            'database' => getenv('DB_NAME' , 'cls_charity'),
            'username' => getenv('DB_USERNAME' , 'sarge_charity'),
            'password' => getenv('DB_PASSWORD', 'rrwcscrz1_charity'),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => ''
        ]);

        $db->setAsGlobal();
        $db->bootEloquent();
    }
}