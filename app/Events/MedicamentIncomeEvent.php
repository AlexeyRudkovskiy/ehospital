<?php

namespace App\Events;

use App\Medicament;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MedicamentIncomeEvent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @var Medicament
     */
    public $medicament;

    /**
     * @var float
     */
    public $balance = 0;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Medicament $medicament)
    {
        $this->medicament = $medicament;
        $this->balance = $medicament->balance();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return [
            'eh.medicament.' . $this->medicament->id . '.income'
        ];
    }
}
