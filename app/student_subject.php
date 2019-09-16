<?php

namespace App;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;

class student_subject extends Model
{
    public $table = 'student_subject';
    public $fillable=['testone','testtwo','testthree','exam','session_id','term_id'];

}
