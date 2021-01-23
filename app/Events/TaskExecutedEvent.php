<?php

namespace App\Events;

use App\Task;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TaskExecutedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $task;
    public $elapsed_time;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Task $task, $elapsed_time)
    {
        $this->task = $task;
        $this->elapsed_time = $elapsed_time;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
