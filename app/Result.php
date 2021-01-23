<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = ['duration','result'];

    protected $dates = ['ran_at'];

}
