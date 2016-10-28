<?php

namespace App;

use App\Events\NomenclatureBatchBalanceUpdated;
use App\Events\NomenclatureHistoryUpdatedEvent;
use App\Traits\RevisionsTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class NomeclatureShow
 *
 * @author Alexey Rudkovskiy
 * @package App
 */
class Nomenclature extends Model
{

    use RevisionsTrait;

    /**
     * Отключаем колонки created_at, updated_at
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Разрешаем заполнять эти поля
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'name_for_department',
        'small_name',
        'amount_in_a_package',
        'keep_records_by_series',
        'nds',
        'barcode',
        'morion_code',
        'inn_name',

        'set_id',
        'base_unit_id',
        'basic_unit_id',
        'manufacturer_id',
        'atc_classification_id'
    ];

    protected $casts = [
        'keep_records_by_series' => 'bool'
    ];

    /**
     * Календарные дни, в которых есть эти медикаменты
     *
     * @see \App\CalendarDay
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function calendarDays()
    {
        return $this->belongsToMany(CalendarDay::class);
    }

    /**
     * Производительно
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    /**
     * Серия и дата производства
     *
     * @see \App\NomenclatureBatch
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function batches()
    {
        return $this->hasMany(NomenclatureBatch::class);
    }

    /**
     * АТС классификация
     *
     * @see \App\AtcClassification
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function atcClassification()
    {
        return $this->belongsTo(AtcClassification::class);
    }

    /**
     * История медикаменты
     *
     * @see \App\NomenclatureHistory
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function history()
    {
        return $this->hasMany(NomenclatureHistory::class)->orderBy('id', 'desc');
    }

    /**
     * История вместе с забронированными медикаментами
     *
     * @see \App\NomenclatureHistory
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function historyWithoutArmored()
    {
        return $this->history()->where('status', '!=', 'armored');
    }

    /**
     * Баланс медикамента
     *
     * @return int
     */
    public function balance()
    {
        $data = $this->historyWithoutArmored;
        $val = 0;
        foreach ($data as $item) {
            $val += $item->status == 'income' ? $item->amount : -$item->amount;
        }
        return $val;
    }

    /**
     * Базовая единица измерения
     *
     * @see \App\Unit
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function baseUnit()
    {
        return $this->belongsTo(Unit::class, 'base_unit_id');
    }

    /**
     * Основная единица измерений
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function basicUnit()
    {
        return $this->belongsTo(Unit::class, 'basic_unit_id');
    }

    /**
     * Регистрируем поступление товара
     *
     * @param float $amount
     * @param NomenclatureBatch $batch
     * @param array $attributes дополнительные аттрибуты
     * @return Model
     */
    public function income($amount, $batch = null, $attributes = [])
    {
        return $this->addToHistory($amount, 'income', $attributes, $batch);
    }

    public function outgoing($amount, $batch = null, $attributes = [])
    {
        return $this->addToHistory($amount, 'outgoing', $attributes, $batch);
    }

    public function armor($amount, $batch = null, $attributes = [])
    {
        return $this->addToHistory($amount, 'armored', $attributes, $batch);
    }

    /**
     * Добавляем информацию в историю
     *
     * @param float $amount
     * @param string $status
     * @param array $attributes
     * @param NomenclatureBatch $batch
     * @return NomenclatureHistory
     */
    public function addToHistory($amount, $status, $attributes, $batch = null)
    {
        $createAttributes = [
            'amount' => $amount,
            'status' => $status,
            'user_id' => auth()->id(),
            'nomenclature_batch_id' => $batch->id ?? null
        ];
        $createAttributes = array_merge($createAttributes, $attributes);
        $nomenclatureHistory = $this->history()->create($createAttributes);
        event(new NomenclatureBatchBalanceUpdated($this, $this->balance(), $status == 'income' ? $amount : -$amount, $status, $batch));
        event(new NomenclatureHistoryUpdatedEvent($this->history()->take(1)->get()->first()));
        return $nomenclatureHistory;
    }

    public function getBatchList()
    {
        $batchesRaw = $this->batches;
        $batchesRaw = $batchesRaw->toArray();
        $batchesRaw = array_map(function ($batch) {
            return [
                $batch['id'],
                $batch['expiration_date'] . ' ' . $batch['batch_number']
            ];
        }, $batchesRaw);

        $batchesRaw = array_values($batchesRaw);
        $batches = [];
        foreach ($batchesRaw as $item) {
            $batches[$item[0]] = $item[1];
        }

        return $batches;
    }

}
