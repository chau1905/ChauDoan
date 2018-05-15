<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    const TYPE_SERVICE = 1;
    const TYPE_PRODUCT = 2;
    protected $table = 'categories';
    protected $fillable = ['id','name', 'type', 'description'];
    public $timestamps = true;
}
