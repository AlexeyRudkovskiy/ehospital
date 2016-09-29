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
     * Формат времени для вывода на печать
     *
     * H - часы в 24-х часовом формате
     * i - минуты с ведущим нулём
     *
     * @var string
     */
    protected $timeFormat = 'H:i';

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

    public function getDayOfWeek($numeric = true)
    {
        if (!$numeric) {
            $days =  [
                'monday',
                'tuesday',
                'wednesday',
                'thursday',
                'friday',
                'saturday',
                'sunday'
            ];
            // Отнимаем единицу так как нам нужны индексы а не номера дней недели по порядку
            return $days[$this->day_of_week - 1];
        }
        return $this->day_of_week;
    }

    public function period()
    {
        return $this->from->format($this->timeFormat) . ' - ' . $this->to->format($this->timeFormat);
    }

    public function getPerPatientFormated()
    {
        $step = Carbon::parse($this->per_patient);

        return $step->format($this->timeFormat);
    }

}
