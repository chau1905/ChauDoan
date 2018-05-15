<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const PAID = 1;
    const ORDER = 0;
    const UNPAID = 2;
    const CANCEL = 3;

    protected $table = 'orders';
    protected $fillable = ['id', 'table_id', 'total', 'status'];
    public $timestamps = true;

}
