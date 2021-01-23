<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seeker extends Model
{
    public $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function upload_groups(){
        return $this->hasMany(UploadGroups::class, 'group_id', 'image_id');
    }
}
