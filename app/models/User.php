<?php


namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class User extends Model{
    public $timestamps = true;
    protected $fillable = ['userid', 'surname', 'firstname', 'email', 'password'];
}