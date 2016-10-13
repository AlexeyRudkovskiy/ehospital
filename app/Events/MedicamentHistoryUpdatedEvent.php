<?php

namespace App\Events;

use App\Medicament;
use App\MedicamentBatch;
use App\MedicamentHistory;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MedicamentHistoryUpdatedEvent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $history;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(MedicamentHistory $history)
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
            'eh.medicament.' . $this->history->medicament->id . '.history'
        ];
    }
}
