<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $guarded = [];
    public $table = 'classroom';

    public function student(){
        return $this->hasMany(Student::class);
    }
}
