<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;

    // channel
    public function channel(){
        return $this->belongsTo(Channel::class);
    }

    // user
    public function user(){
        return $this->belongsTo(User::class);
    }

    // answer
    public function answers(){
        return $this->belongsTo(Answer::class);
    }
}
