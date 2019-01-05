<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = [];

    public function classroom(){
        return $this->belongsTo(Classroom::class);
    }
    public function subjects(){
        return $this->belongsToMany(Subject::class);
    }
}
