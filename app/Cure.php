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

    protected $with = [
        'status',
        'days'
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

    /**
     * Статус курса лечения. Берёться из БД из таблицы cure_statuses.
     * Пример статусов: выписан, госпитализация, дневной стационар...
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(CureStatus::class, 'cure_status_id');
    }

    /**
     * Основной доктор в этом курсе лечения
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function doctor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function doctors()
    {
        return $this->belongsToMany(User::class);
    }

}
