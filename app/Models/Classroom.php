<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    public $table = 'classrooms';
    protected $guarded = [];
    public function student()
    {
        return $this->hasMany(Student::class);
    }
    public function subjects(){
        return $this->belongsToMany(Subject::class);
    }
    public function sections(){
        return $this->belongsToMany(sections::class);
    }
    public function teachers()
    {
        return $this->hasMany(Classroom::class);
    }



}
