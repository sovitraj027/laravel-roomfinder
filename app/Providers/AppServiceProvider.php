<?php

namespace App\Providers;

use App\Task;
use App\Observers\TaskObserver;
use App\Events\TaskExecutedEvent;
use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot()
    {
        /* Task Observers for caching */
        Task::observe(TaskObserver::class);

        /* Scheduling logic */
        $this->app->resolving(Schedule::class, function ($schedule) {
            $this->schedule($schedule);
        });
    }

    public function schedule(Schedule $schedule)
    {
        /* fetch all the active tasks */
        $tasks = app('App\Task')->getActive();

        /* schedule the tasks */
        foreach ($tasks as $task) {
            $event = $schedule->exec($task->command);
            $event
                ->cron($task->expression)
                ->before(function () use ($event) {
                    //before task starts get start time
                    $event->start_time = microtime(true);
                })
                ->after(function () use ($event, $task) {

                    //after execution sub current time with start-time
                    $elapsed_time = microtime(true) - $event->start_time;

                    event(new TaskExecutedEvent($task, $elapsed_time));
                })
                //creating temp file to store o/p.
                ->sendOutputTo(storage_path('task-' . sha1($task->command . $task->expression)));

            if ($task->dont_overlap) {
                $event->withoutOverlapping();
            }

            if ($task->run_in_maintenance) {
                $event->evenInMaintenanceMode();
            }
        }
    }
}
