<?php

namespace App;

use App\Room;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Applicant extends Model
{
    use Notifiable;

    protected $guarded = [];

    public $timestamps = false;

    public function rooms()
    {
        return $this->belongsToMany(Room::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notifications()
    {
        return $this->morphTo();
    }
}
