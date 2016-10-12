<?php

namespace App\Events;

use App\MedicamentBatch;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BatchChangedEvent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $batch;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(MedicamentBatch $batch)
    {
        $this->batch = $batch;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return [
            'eh.medicament.' . $this->batch->medicament->id . '.batch.created.' . $this->batch->id
        ];
    }
}
