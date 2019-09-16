<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['matric_no','first_name','last_name','gender','DOB'];

    public function classroom(){
        return $this->belongsTo(Classroom::class);
    }
    public function subjects(){
        return $this->belongsToMany(Subject::class);

    }
}
