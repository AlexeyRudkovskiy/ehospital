<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Notification implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @var string
     */
    public $text;

    /**
     * @var string
     */
    public $type;

    /**
     * @var object[]
     */
    public $actions = [];

    /**
     * @var integer
     */
    private $userId = -1;

    /**
     * Create a new event instance.
     *
     * @param string $text
     * @param string $type
     */
    public function __construct(string $text, string $type)
    {
        $this->text = $text;
        $this->type = $type;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return [
            'eh.notification.' . ($this->userId > 0 ? $this->userId : auth()->id())
        ];
    }

    public function addAction ($text, $action) {
        array_push($this->actions, [
            'text' => $text,
            'action' => $action
        ]);
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId) {
        $this->userId = $userId;
    }

}
