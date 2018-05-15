<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $table = 'salary';
    protected $fillable = ['id','user_id', 'salary', 'created_at', 'updated_at'];
    public $timestamps = true;
}
