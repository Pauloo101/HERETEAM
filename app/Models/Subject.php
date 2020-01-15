<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function classrooms(){
        return $this->belongsToMany(Classroom::class);
    }
    public function students(){
        return $this->belongsToMany(Student::class)
            ->withPivot('id','classroom_name','testone','testtwo','testthree','exam');
    }
    public function teachers()
    {
        return  $this->belongsToMany(Teacher::class, 'subject_teacher')->withPivot('session_id', 'term_id', 'section_id', 'classroom_id');
    }

}
