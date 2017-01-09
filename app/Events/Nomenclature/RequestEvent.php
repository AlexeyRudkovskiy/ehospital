<?php

namespace App\Events\Nomenclature;

use App\NomenclatureRequest;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class RequestEvent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @var NomenclatureRequest
     */
    public $request;

    /**
     * Create a new event instance.
     *
     * @param NomenclatureRequest $nomenclatureRequest
     */
    public function __construct(NomenclatureRequest $nomenclatureRequest)
    {
        $this->request = $nomenclatureRequest;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return [
            'eh.nomenclature.request'
        ];
    }
}
