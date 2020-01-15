<?php

namespace App;

use App\Models\Complain;
use App\Models\Notification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

// use Illuminate\Database\Eloquent\Model;

class Parents extends Authenticatable
{
    use HasApiTokens, Notifiable;

    public $table = 'parent';


    //relationship from online
    protected $guraded =[];
     protected $hidden = ['password'];

     public function students(){
         return $this->hasMany(Students::class);
     }
     public function complains(){
         return $this->hasMany(Complain::class);
     }
     public function notifications(){
         return $this->belongsToMany(Notification::class,
        'notification_parent','parent_id','notification_id');
     }

}
