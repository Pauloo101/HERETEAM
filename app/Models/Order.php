<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    Public function products(){
    //   return $this->belongsToMany('App\Role', 'role_user_table', 'user_id', 'role_id');
    return $this->belongsToMany(Product::class)->withPivot('order_code', 'quantity', 'product_id', 'comments');

    }
}
