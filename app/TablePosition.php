<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TablePosition extends Model
{
    protected $table = 'tables_position';
    protected $fillable = ['id','name', 'description'];
    public $timestamps = true;
}
