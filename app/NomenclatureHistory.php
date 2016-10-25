<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class NomenclatureHistory
 *
 * @author Alexey Rudkovskiy
 * @package App
 */
class NomenclatureHistory extends Model
{

    /**
     * Отключаем колонки created_at, updated_at
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Ращрешаем заполнять эти поля
     *
     * @var array
     */
    protected $fillable = [
        'amount',
        'status',
        'user_id',
        'nomenclature_batch_id'
    ];

    protected $with = [
        'user',
        'batch'
    ];

    /**
     * Медикамент, которому принадлежит элемент истории
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nomenclature()
    {
        return $this->belongsTo(Nomenclature::class);
    }

    /**
     * Пользователь, сделавший изменения(создал запись)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Единица измерений, в которой измеряется текущая запись
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    /**
     * Если запись сделана в связи с курсом лечения - указываем в какой именно день
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function calendarDay()
    {
        return $this->belongsTo(CalendarDay::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function batch()
    {
        return $this->belongsTo(NomenclatureBatch::class, 'nomenclature_batch_id');
    }

    /**
     * Возвращает "разницу", а именно если запись в истории имеет статус icome - просто вернёт amount.
     * Если запись имеет статус отличный от income, то -amount.
     *
     * @return float
     */
    public function getDelta()
    {
        return $this->status == 'income' ? $this->amount : -($this->amount);
    }

}
