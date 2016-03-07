<?php

namespace App\Events\RiskEvents;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class RiskSaved extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $risk;
    public $tree;
    public $parent;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(\App\Risk $risk)
    {
        $this->risk = $risk;
        $this->tree = [
            'id' => $risk->tree->id,
            'public' => $risk->tree->public
        ];
        $this->parent = [
            'type' => 'tree',
            'id' => $risk->tree->id
        ];
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
