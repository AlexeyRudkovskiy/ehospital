<?php

namespace App\Events;

use App\Nomenclature;
use App\NomenclatureBatch;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NomenclatureBatchBalanceUpdated implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @var Nomenclature
     */
    public $nomenclature;

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
     * @var NomenclatureBatch
     */
    public $batch = null;

    /**
     * Create a new event instance.
     *
     * @param Nomenclature $nomenclature
     * @param float $balance
     * @param float $delta
     * @param string $type
     */
    public function __construct(Nomenclature $nomenclature, float $balance, float $delta, string $type, $batch = null)
    {
        $this->nomenclature = $nomenclature;
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
            'eh.nomenclature.' . ($this->nomenclature->id) . '.balance'
        ];
    }
}
