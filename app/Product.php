<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Elasticquent\ElasticquentTrait;

class Product extends Model
{
//    use ElasticquentTrait;

    protected $table = 'products';
    protected $fillable = ['id','image', 'name', 'price','category_id', 'description', 'created_at', 'updated_at'];
    public $timestamps = true;

}
