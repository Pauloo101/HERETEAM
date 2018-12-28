<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = [];

    public function classrm(){
        return $this->belongsTo(Classroom::class);
    }
}
