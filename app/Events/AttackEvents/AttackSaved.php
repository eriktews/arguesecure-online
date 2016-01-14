<?php

namespace App\Events\AttackEvents;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AttackSaved extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $attack;
    public $tree;
    public $parent;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(\App\Attack $attack)
    {
        $this->attack = $attack;
        $this->tree = [
            'id' => $attack->tree->id,
            'public' => $attack->tree->public
        ];
        $this->parent = [
            'type' => 'risk',
            'id' => $attack->risk->id
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
