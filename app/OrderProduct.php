<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    //table name
    protected $table='order_product';
    //primary key
    protected $primary_key='id';
    //timestamps
    public $timestamp=true;

    public function product(){
        return $this->belongsTo('App\Product');
    }

    public function order(){
        return $this->belongsTo('App\Order');
    }

    public function flavour(){
        return $this->belongsTo('App\Flavour');
    }
}
