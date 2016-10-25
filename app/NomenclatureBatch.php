<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class NomenclatureBatch
 *
 * @author Alexey Rudkovskiy
 * @package App
 */
class NomenclatureBatch extends Model
{

    /**
     * Отключаем колонки created_at, updated_at
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Указываем, какие поля можно заполнять
     *
     * @var array
     */
    protected $fillable = [
        'expiration_date',
        'batch_number',
        'price',
        'nomenclature_id'
    ];

    /**
     * Медикамент, к которому относится серия
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nomenclature()
    {
        return $this->belongsTo(Nomenclature::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function batch()
    {
        return $this->belongsTo(NomenclatureBatch::class);
    }

    public function getBalance()
    {
        $balance = 0;
        $history = NomenclatureHistory::where('nomenclature_id', $this->nomenclature_id)->where('nomenclature_batch_id', $this->id)->get();
        foreach ($history as $item) {
            $balance += $item->getDelta();
        }
        return $balance;
    }

}
