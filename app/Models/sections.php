<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sections extends Model
{
    public function classrooms(){
        return $this->belongsToMany(Classroom::class);
    }
}
