<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table="categories";
    public function parent()
    {
        return $this->belongsTo('App\Category', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Category', 'parent_id');
    }

    public function categories_products(){
        return $this->hasMany('App\CategoryProduct');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }
}
