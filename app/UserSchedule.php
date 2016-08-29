<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserSchedule
 *
 * @author Alexey Rudkovskiy
 * @package App
 */
class UserSchedule extends Model
{

    /**
     * Разрешаем заполнять эти поля
     *
     * @var array
     */
    protected $fillable = [
        'from', 'to', 'per_patient', 'day_of_week',
        // TODO: Remove it in future
        'user_id'
    ];

    protected $casts = [
        'day_of_week' => 'integer'
    ];

    /**
     * Пользователь, к которому относится данное расписание
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFromAttribute()
    {
        return Carbon::parse($this->attributes['from']);
    }

    public function getToAttribute()
    {
        return Carbon::parse($this->attributes['to']);
    }

}
