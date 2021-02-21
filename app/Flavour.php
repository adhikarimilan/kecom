<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flavour extends Model
{
    //table name
    protected $table='flavour';
    //primary key
    protected $primary_key='id';
    //timestamps
    public $timestamp=true;

    public function product(){
       return $this->belongsTo('App\Product');
    }

    public function cart(){
        return $this->hasMany('App\Cart');
     }

     public function order_product(){
      return $this->hasMany('App\OrderProduct');
  }
}
