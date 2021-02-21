<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    //table name
    protected $table='category_product';
    //primary key
    protected $primary_key='id';
    //timestamps
    public $timestamp=true;

    public function product(){
        return $this->belongsTo('App\Product');
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }
}
