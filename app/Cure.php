<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cure
 *
 * @author Alexey Rudkovskiy
 * @package App
 */
class Cure extends Model
{

    public $timestamps = false;

    public $dates = [
        self::CREATED_AT
    ];

    /**
     * Разрешаем заполнять эти поля
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'department_id',
        'patient_id',
        'hospitalization_date',
        'discharge_date',
        'cure_status_id',
        'diagnosis',
        'comment',
        'review'
    ];

    protected $with = [
        'status',
        'days'
    ];

    protected $casts = [
        'review' => 'array'
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
        return $this->hasMany(CalendarDay::class)->orderBy('day');
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function doctors()
    {
        return $this->belongsToMany(User::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * @return static
     */
    public function getHospitalizationDateAttribute()
    {
        return Carbon::parse($this->attributes['hospitalization_date']);
    }

    /**
     * @return null|static
     */
    public function getDischargeDateAttribute()
    {
        if ($this->attributes['discharge_date'] != null) {
            return Carbon::parse($this->attributes['discharge_date']);
        }
        return null;
    }

    public function granted(User $user)
    {
        $isGrunted = $this->patient->granted($user) || $this->doctor->isParent($user);
        if (!$isGrunted) {
            abort(403);
        }
        return $isGrunted;
    }

    public function isHeadNurse(User $user)
    {
        return $this->department->leader->id === $user->id;
    }

}
