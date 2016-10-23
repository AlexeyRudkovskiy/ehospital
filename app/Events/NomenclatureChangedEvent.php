<?php

namespace App\Events;

use App\Nomenclature;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NomenclatureChangedEvent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @var Nomenclature
     */
    public $nomenclature;

    /**
     * Create a new event instance.
     *
     * @param Nomenclature $nomenclature
     */
    public function __construct(Nomenclature $nomenclature)
    {
        $this->nomenclature = $nomenclature;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return [
            'eh.nomenclature.' . $this->nomenclature->id
        ];
    }
}
