<?php

namespace App;

use App\Applicant;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class, 'user_id', 'user_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function upload_groups()
    {
        return $this->hasMany(UploadGroups::class, 'group_id', 'image_id');
    }

    public function applicants()
    {
        return $this->hasManyThrough(Applicant::class, Room::class, 'user_id', 'room_id', 'user_id', 'id');
    }
}
