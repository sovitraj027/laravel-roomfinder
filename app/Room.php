<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    protected $guarded = [];

    use SoftDeletes;

    public function upload_groups()
    {
        return $this->hasMany(UploadGroups::class, 'group_id', 'images');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class, 'user_id', 'user_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function facilities()
    {
        return $this->belongsToMany(Facility::class);
    }

    public function applicants()
    {
        return $this->belongsToMany(Applicant::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function is_bookmarked()
    {
        $auth_user = auth()->id();

        $all_bookmarks = array();

        foreach ($this->bookmarks as $bookmark):
            array_push($all_bookmarks, $bookmark->user_id);
        endforeach;

        if (in_array($auth_user, $all_bookmarks)) {
            return true;
        } else {
            return false;
        }
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }


    //accessors ->manipulates the incoming data from DB before showing it to view

    public function getTitleAttribute()
    {
        return Str::limit($this->attributes['title'], 20);

    }

    public function getTitleLimitAttribute()
    {
        return $this->attributes['title'];
        //return Str::limit($this->title, 20);
    }

    public function getCreatedAtAttribute($value)
    {
        // return \Carbon\Carbon::parse($value)->toFormattedDateString();
        return \Carbon\Carbon::parse($value)->diffForHumans();
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

}
