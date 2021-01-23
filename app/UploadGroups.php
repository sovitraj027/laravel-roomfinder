<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadGroups extends Model
{
    protected $guarded = [];

    public function upload(){
        return $this->hasOne('App\Uploads', 'id', 'upload_id');
    }
}
