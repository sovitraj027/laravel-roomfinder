<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    /* BelongsTo Relationship */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
