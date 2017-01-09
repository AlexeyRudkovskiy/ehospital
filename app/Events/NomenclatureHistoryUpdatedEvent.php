<?php

namespace App\Events;

use App\Nomenclature;
use App\NomenclatureBatch;
use App\NomenclatureHistory;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NomenclatureHistoryUpdatedEvent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $history;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(NomenclatureHistory $history)
    {
        $this->history = $history;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return [
            'eh.nomenclature.' . $this->history->nomenclature->id . '.history'
        ];
    }
}
