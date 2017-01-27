<?php

namespace App\Events\Patient;

use App\Cure;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CureHeadNurseReview implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @var Cure
     */
    public $cure;

    /**
     * Create a new event instance.
     *
     * @param Cure $cure
     */
    public function __construct(Cure $cure)
    {
        $this->cure = $cure;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return [ CureHeadNurseReview::class ];
    }
}
