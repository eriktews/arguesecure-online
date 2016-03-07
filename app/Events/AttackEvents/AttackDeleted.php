<?php

namespace App\Events\AttackEvents;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AttackDeleted extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $attack;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(\App\Attack $attack)
    {
        $this->attack = $attack;
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
