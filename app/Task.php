<?php

namespace App;

use Cron\CronExpression;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;

class Task extends Model
{
    use Notifiable;

    protected $fillable = [
        'description',
        'command',
        'expression',
        'is_active',
        'dont_overlap',
        'run_in_maintenance',
        'notification_email',
    ];

    /* Defining Accessors */
    public function getLastRunAttribute()
    {
        //last is instance of Result model
        $last = $this->results()->orderBy('id', 'desc')->first();
        if ($last) {
            return $last->ran_at->format('Y-m-d h:i A');
        }
        return 'N/A';
    }

    public function getAverageRuntimeAttribute()
    {
        return number_format($this->results()->avg('duration') / 1000, 2);
    }

    public function getNextRunAttribute()
    {
        return CronExpression::factory($this->getCronExpression())
            ->getNextRunDate('now', 0, false, 'Asia/Kathmandu')->format('Y-m-d h:i A');
    }

    public function getCronExpression()
    {
        return $this->expression ?: '* * * * *';
    }

    /* Has Many Relationship */
    public function results()
    {
        return $this->hasMany(Result::class);
    }


    /* custom fuctions */

    public function getActive()
    {
        return Cache::rememberForever('tasks.active', function () {
            // return $this->where('is_active', true)->get();
            return $this->getAll()->filter(function ($task) {
                return $task->is_active;
            });
        });
    }

    public function getAll()
    {
        return Cache::rememberForever('tasks.all', function () {
            return $this->all();
        });
    }

    //as laravel automatically looks for 'email' attribute but we have notification_email attribute.
    public function routeNotificationForMail()
    {
        return $this->notification_email;
    }
}
