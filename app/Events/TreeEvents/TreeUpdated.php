<?php

namespace App\Events\TreeEvents;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TreeUpdated extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $tree;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(\App\Tree $tree)
    {
        return $this->tree = $tree;
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
