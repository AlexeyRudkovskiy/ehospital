<?php

namespace App\Events;

use App\Classes\UserChannel;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Logging\Log;
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
     * @var User
     */
    private $user;

    /**
     * Create a new event instance.
     *
     * @param string $text
     * @param string $type
     */
    public function __construct(string $text, string $type, User $user = null)
    {
        $this->text = $text;
        $this->type = $type;

        if ($user == null) {
            \Log::info('No notification target defined. Sending to first user');
            $this->user = User::first();
        } else {
            $this->user = $user;
        }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new UserChannel(self::class, $this->user);
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
        // todo: remove this hack
        $this->user = User::find($userId);
    }

    public function setUser(User $user)
    {
        $this->user = $user;
        $this->userId = $user->id;
    }

}
