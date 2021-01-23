<?php

namespace App;

use App\User;
use App\ReportCategory;
use Illuminate\Database\Eloquent\Model;

class RequestReport extends Model
{
    protected $guarded = [];

    public function report_category()
    {
        return $this->hasOne(ReportCategory::class, 'id','report_category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
