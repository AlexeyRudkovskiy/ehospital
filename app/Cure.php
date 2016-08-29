<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cure
 *
 * @author Alexey Rudkovskiy
 * @package App
 */
class Cure extends Model
{

    /**
     * Разрешаем заполнять эти поля
     *
     * @var array
     */
    protected $fillable = [
        'department_id',
        'patient_id'
    ];

    /**
     * Пациент, к которому относится данный курс лечения
     *
     * @see \App\Patient
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Дни курса лечения.
     *
     * @see \App\CalendarDay
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function days()
    {
        return $this->hasMany(CalendarDay::class);
    }

    /**
     * Отделение, в котором происходит курс лечения
     *
     * @see \App\Department
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

}
