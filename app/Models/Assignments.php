<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignments extends Model
{
    public function students()
    {
        return $this->belongsToMany(Student::class)->withPivot('status', 'score');
    }
}
