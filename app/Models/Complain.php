<?php

namespace App\Models;

use App\Parents;
use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    public function parents(){
        return $this->belongsTo(Parents::class);
    }
    public function replys(){
        return $this->hasMany(Reply::class);
    }
}
