<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PatientCard
 *
 * @deprecated
 * @author Alexey Rudkovskiy
 * @package App
 */
class PatientCard extends Model
{

    /**
     * Разрешаем заполнять эти полня
     *
     * @var array
     */
    protected $fillable = [
        'department_id'
    ];

    /**
     * Пациент, которому принадлежит эта карточка
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Дни лечения
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function days()
    {
        return $this->hasMany(CalendarDay::class);
    }

}
