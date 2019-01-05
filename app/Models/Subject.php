<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function classrooms(){
        return $this->belongsToMany(Classroom::class);
    }
    public function student(){
        return $this->belongsToMany(Student::class);
    }
}