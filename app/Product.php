<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //table name
    protected $table='products';
    //primary key
    protected $primary_key='id';
    //timestamps
    public $timestamp=true;

    public function carts(){
        return $this->hasmany('App\Cart');
    }

    public function order_product(){
        return $this->hasmany('App\OrderProduct');
    }

    // public function category_product(){
    //     return $this->hasmany('App\CategoryProduct');
    // }

    public function category_product()
    {
        return $this->hasMany('App\CategoryProduct');
    }

    public function price()
    {
        if($this->sale_price)
        return $this->sale_price;
        return $this->reg_price;
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

}
