<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $guarded = [];

    public function classrooms(){
        return $this->belongsToMany(Classroom::class, 'classroom_teacher')->withPivot('classroom_id', 'teacher_id', 'section_id', 'session_id', 'term_id')->withTimestamps();
    }
    public function subjects()
    {
        return  $this->belongsToMany(Subject::class, 'subject_teacher')->withPivot('session_id','term_id','section_id','classroom_id');
    }

}
