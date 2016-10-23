<?php

namespace App\Events;

use App\NomenclatureBatch;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BatchCreatedEvent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @var NomenclatureBatch
     */
    public $batch;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(NomenclatureBatch $batch)
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
            'eh.nomenclature.' . $this->batch->nomenclature->id . '.batch.created.' . $this->batch->id
        ];
    }
}
