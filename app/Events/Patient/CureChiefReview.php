<?php

namespace App\Events\Patient;

use App\Classes\UserChannel;
use App\Cure;
use App\Permission;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CureChiefReview implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @var Cure
     */
    public $cure;

    /**
     * @var User
     */
    private $broadcastTo;

    /**
     * Create a new event instance.
     *
     * @param Cure $cure
     */
    public function __construct(Cure $cure)
    {
        $this->cure = $cure;
        $this->broadcastTo = User::wherePermissionId(Permission::CHIEF_MEDICAL_OFFICER)->first();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new UserChannel(self::class, $this->broadcastTo);
    }
}
