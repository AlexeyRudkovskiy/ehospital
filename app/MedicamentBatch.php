<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MedicamentBatch
 *
 * @author Alexey Rudkovskiy
 * @package App
 */
class MedicamentBatch extends Model
{

    /**
     * Указываем, какие поля можно заполнять
     *
     * @var array
     */
    protected $fillable = [
        'expiration_date',
        'batch_number',
        'price',
        'medicament_id'
    ];

    /**
     * Медикамент, к которому относится серия
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function medicament()
    {
        return $this->belongsTo(Medicament::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function batch()
    {
        return $this->belongsTo(MedicamentBatch::class);
    }

    public function getBalance()
    {
        $balance = 0;
        $history = MedicamentHistory::where('medicament_id', $this->medicament_id)->where('medicament_batch_id', $this->id)->get();
        foreach ($history as $item) {
            $balance += $item->getDelta();
        }
        return $balance;
    }

}
