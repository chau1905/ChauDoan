<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'history';
    protected $fillable = ['id','user_id', 'service_id'];
    public $timestamps = true;
}
