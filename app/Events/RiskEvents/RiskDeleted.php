<?php

namespace App\Events\RiskEvents;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class RiskDeleted extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $risk;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(\App\Risk $risk)
    {
        $this->risk = $risk;
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
