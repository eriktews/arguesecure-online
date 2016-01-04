<?php

namespace App\Events\RiskEvents;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class RiskDeleted extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $Risk;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(\App\Risk $Risk)
    {
        $this->Risk = $Risk;
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
