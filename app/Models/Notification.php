<?php

namespace App\Models;

use App\Parents;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public function parents(){
        return $this->belongsToMany(Parents::class, 'notification_parent', 'notification_id','parent_id');
    }
}
