<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    public function rooms()
    {
        return $this->belongsToMany(Room::class);
    }
}
