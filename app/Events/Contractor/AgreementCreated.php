<?php

namespace App\Events\Contractor;

use App\Agreement;
use App\Contractor;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AgreementCreated implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @var Agreement
     */
    public $agreement;

    /**
     * @var Contractor
     */
    protected $contractor;

    /**
     * Create a new event instance.
     *
     * @param Contractor $contractor
     * @param Agreement $agreement
     */
    public function __construct(Contractor $contractor, Agreement $agreement)
    {
        $this->contractor = $contractor;
        $this->agreement = $agreement;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return [
            'eh.contractor.' . ($this->contractor->id) . '.agreement.created'
        ];
    }
}
