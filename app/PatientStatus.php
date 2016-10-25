<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

/**
 * Class PatientStatus
 *
 * @author Alexey Rudkovskiy
 * @package App
 */
class PatientStatus extends Model
{

    /**
     * Отключаем колонки created_at, updated_at
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Поля, которые разрешено заполнять
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'patient_id',
        'made_by_id',
        'department_id'
    ];

    /**
     * Пациент, к которому относится статус
     *
     * @see \App\Patient
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Пользователь сделавший статус
     *
     * @see \App\User
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function doctor()
    {
        return $this->belongsTo(User::class, 'made_by_id');
    }

    /**
     * Отделение, к которому прикреплён статус
     *
     * @see \App\Department
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

}
