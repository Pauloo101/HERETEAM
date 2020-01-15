<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = [];

    public function students()
    {
        return $this->belongsToMany(Student::class)->withPivot('payment_description', 'payment_method', 'payment_reference', 'status','total','pending');
    }
}
