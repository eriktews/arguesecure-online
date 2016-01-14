<?php

namespace App\Events\DefenceEvents;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DefenceSaved extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $defence;
    public $tree;
    public $parent;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(\App\Defence $defence)
    {
        $this->defence = $defence->load('attacks');
        $this->tree = [
            'id' => $defence->tree->id,
            'public' => $defence->tree->public
        ];
        $this->parent = [
            'type' => 'attack',
            'id' => $defence->tempAttacks
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
