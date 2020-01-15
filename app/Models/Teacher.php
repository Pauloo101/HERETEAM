<?php

namespace App\Models;

use App\User;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Teacher extends Authenticatable
{

    use HasApiTokens, Notifiable;

    protected $guard = 'teacher';

    protected $guarded = [];

    public function classrooms(){
        return $this->belongsToMany(Classroom::class, 'classroom_teacher')->withPivot('classroom_id', 'teacher_id', 'section_id', 'session_id', 'term_id')->withTimestamps();
    }
    public function subjects()
    {
        return  $this->belongsToMany(Subject::class, 'subject_teacher')->withPivot('session_id','term_id','section_id','classroom_id');
    }

    protected $hidden = ['password', 'remember_token'];
}
