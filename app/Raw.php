<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Raw extends Model
{
    protected $table = 'raw';
    protected $fillable = ['id','name', 'price', 'price','quantity', 'unit', 'category_id', 'description'];
    public $timestamps = false;
}
