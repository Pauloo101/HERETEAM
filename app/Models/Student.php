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
    public function payments()
    {
        return $this->belongsToMany(Payment::class)->withPivot('payment_description', 'payment_method', 'payment_reference', 'status','total','pending');
    }
    public function assignments()
    {
        return $this->belongsToMany(Assignments::class)->withPivot('status','score');
    }
    public function tickets(){
        return $this->hasOne(Ticket::class);
    }
}
