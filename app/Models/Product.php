<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded=[];

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('order_code','quantity','product_id','comments');
    }
}
