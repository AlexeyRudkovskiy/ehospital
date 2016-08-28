<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MedicamentHistory
 *
 * @author Alexey Rudkovskiy
 * @package App
 */
class MedicamentHistory extends Model
{

    /**
     * Ращрешаем заполнять эти поля
     *
     * @var array
     */
    protected $fillable = [
        'amount', 'status', 'user_id'
    ];

    /**
     * Медикамент, которому принадлежит элемент истории
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function medicament()
    {
        return $this->belongsTo(Medicament::class);
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



}
