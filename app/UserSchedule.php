<?php

namespace App;

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

    /**
     * Пользователь, к которому относится данное расписание
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
