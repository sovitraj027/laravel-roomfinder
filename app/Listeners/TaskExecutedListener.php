<?php

namespace App\Listeners;

use App\Events\TaskExecutedEvent;
use App\Notifications\TaskCompletedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TaskExecutedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TaskExecutedEvent  $event
     * @return void
     */
    public function handle(TaskExecutedEvent $event)
    {
        if (file_exists(storage_path('task-' . sha1($event->task->command . $event->task->expression)))) {
            //storing content to temp file to variable
            $output = file_get_contents(storage_path('task-' . sha1($event->task->command . $event->task->expression)));

            $event->task->results()->create([
                'duration' => $event->elapsed_time * 1000,
                'result' => $output
            ]);
            //deleting temp file
            unlink(storage_path('task-' . sha1($event->task->command . $event->task->expression)));
        }

        $event->task->notify(new TaskCompletedNotification());
    }
}
