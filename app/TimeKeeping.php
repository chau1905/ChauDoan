<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeKeeping extends Model
{
    const CA_SANG = 1;
    const CA_TOI = 2;
    protected $table = 'time_keeping';
    protected $fillable = ['id','user_id', 'type', 'total', 'name', 'time', 'created_at', 'updated_at'];
    public $timestamps = true;
}
