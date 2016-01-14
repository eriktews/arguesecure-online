<?php

namespace App\Events\DefenceEvents;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class DefenceCreated extends Event implements ShouldBroadcastNow
{
    use SerializesModels;

    public $defence;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(\App\Defence $defence)
    {
        $this->defence = $defence;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['argue'];
    }
}
