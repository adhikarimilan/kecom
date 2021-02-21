<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable=[
        'name','time_based','start_time','end_time','coupon_code','discount_type','discount_value','discount_percent','5','max_number_orders','minimum_order_value','limit_per_customer','maximum_discount_value'
    ];
}
