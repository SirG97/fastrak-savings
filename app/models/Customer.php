<?php


namespace App\models;


use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Customer extends Model{
    public $timestamps = true;
    protected $fillable = ['customer_id', 'surname', 'firstname', 'email', 'phone', 'address', 'city', 'state', 'amount'];
} 