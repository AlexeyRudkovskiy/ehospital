<?php

namespace App;

use App\Traits\RevisionsTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Medicament
 *
 * @author Alexey Rudkovskiy
 * @package App
 */
class Medicament extends Model
{

    use RevisionsTrait;

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

        'set_id',
        'base_unit_id',
        'basic_unit_id',
        'manufacturer_id',
        'atc_classification_id'
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
     * @see \App\MedicamentBatch
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function batches()
    {
        return $this->hasMany(MedicamentBatch::class);
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
     * @see \App\MedicamentHistory
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function history()
    {
        return $this->hasMany(MedicamentHistory::class);
    }

    /**
     * История вместе с забронированными медикаментами
     *
     * @see \App\MedicamentHistory
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
     * @param array $attributes дополнительные аттрибуты
     * @return Model
     */
    public function income($amount, $attributes)
    {
        return $this->addToHistory($amount, 'income', $attributes);
    }

    public function outgoing($amount, $attributes)
    {
        return $this->addToHistory($amount, 'outgoing', $attributes);
    }

    public function armor($amount, $attributes)
    {
        return $this->addToHistory($amount, 'armored', $attributes);
    }

    /**
     * Добавляем информацию в историю
     *
     * @param float $amount
     * @param string $status
     * @param array $attributes
     * @return MedicamentHistory
     */
    public function addToHistory($amount, $status, $attributes)
    {
        $createAttributes = [
            'amount' => $amount,
            'status' => $status,
            'user_id' => auth()->id()
        ];
        $createAttributes = array_merge($createAttributes, $attributes);
        return $this->history()->create($createAttributes);
    }

}
