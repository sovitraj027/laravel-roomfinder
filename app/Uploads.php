<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Uploads extends Model
{
    protected $guarded = [];

    public function upload_group(){
        return $this->belongsTo('App\UploadGroups', 'upload_id', 'id');
    }
}
