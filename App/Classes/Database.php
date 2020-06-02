<?php


namespace App\Classes;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database{
    public function __construct(){
        $db = new Capsule();
        $db->addConnection([
            'driver' => 'mysql',
            'host' => 'http://ononiru.com:2082/cpsess5166419065/3rdparty/phpMyAdmin/index.php',
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