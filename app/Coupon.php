<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupon';
    protected $fillable = ['id','uuid', 'timestart', 'timeend','quantity', 'price'];
    public $timestamps = false;
}
