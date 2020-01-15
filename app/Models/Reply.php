<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{

    public $table = 'replys';

    public function complains(){
        return $this->belongsTo(Complain::class);
    }
}
