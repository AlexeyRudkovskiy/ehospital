<?php

namespace App\Events;

use App\Medicament;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MedicamentChangedEvent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @var Medicament
     */
    public $medicament;

    /**
     * Create a new event instance.
     *
     * @param Medicament $medicament
     */
    public function __construct(Medicament $medicament)
    {
        $this->medicament = $medicament;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return [
            'eh.medicament.' . $this->medicament->id
        ];
    }
}
