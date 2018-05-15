<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paysalary extends Model
{
    const PAID = 1;
    const UNPAID = 2;
    protected $table = 'pay_salary';
    protected $fillable = ['id','user_id', 'month', 'year', 'type', 'total'];
    public $timestamps = true;
}
