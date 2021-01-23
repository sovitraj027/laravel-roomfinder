<?php

namespace App;

use App\Role;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function owner()
    {
        return $this->hasOne(Owner::class);
    }

    public function seeker()
    {
        return $this->hasOne(Seeker::class);
    }

    public function place()
    {
        return $this->hasOne(Place::class);
    }

    public function avatar($model)
    {
        $avatar_src = 'https://upload.wikimedia.org/wikipedia/en/f/f9/No-image-available.jpg';

        if ($model == 1) {
            $model = $this->owner;
        } elseif ($model == 2) {
            $model = $this->seeker;
        } else {
            $model = '';
        }
        if ($model) {
            foreach ($model->upload_groups as $upload_group) {
                $avatar = $upload_group->upload;

                if ($avatar)
                    $avatar_src = route('/') . '/app/' . $avatar->filepath . '/' . $avatar->filename;
            }
        }
        return $avatar_src;
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }
}
