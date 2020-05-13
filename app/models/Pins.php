<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Pins extends Model
{
    //
    protected $table = 'pins';

    //change my primary key from id to pin
    protected $primaryKey = 'pin';
    //Tell laravel that the primary key is not an integer
    public $incrementing = false;

}