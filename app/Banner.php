<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable=['title','btn_title','btn_link','photo','status','border'];
}
