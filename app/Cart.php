<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //table name
    protected $table='carts';
    //primary key
    protected $primary_key='id';
    //timestamps
    public $timestamp=true;

    public function product(){
       return $this->belongsTo('App\Product');
    }
    public function flavour(){
        return $this->belongsTo('App\Flavour');
     }
}
