<?php

namespace App\Events;

use App\Medicament;
use App\MedicamentBatch;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MedicamentBatchBalanceUpdated implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @var Medicament
     */
    public $medicament;

    /**
     * @var float
     */
    public $balance;

    /**
     * @var float
     */
    public $delta;

    /**
     * Может быть income, outgoing, armored.
     * income - новое поступление медикамента на склад
     * outgoing - отпуск со склада
     * armored - бронирование медикамента
     *
     * @var string
     */
    public $type;

    /**
     * @var MedicamentBatch
     */
    public $batch = null;

    /**
     * Create a new event instance.
     *
     * @param Medicament $medicament
     * @param float $balance
     * @param float $delta
     * @param string $type
     */
    public function __construct(Medicament $medicament, float $balance, float $delta, string $type, $batch = null)
    {
        $this->medicament = $medicament;
        $this->balance = $balance;
        $this->delta = $delta;
        $this->type = $type;
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
            'eh.medicament.' . ($this->medicament->id) . '.balance'
        ];
    }
}
