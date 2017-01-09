<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Class CalendarDay
 *
 * @author Alexey Rudkovskiy
 * @package App
 */
class CalendarDay extends Model
{

    /**
     * Отключаем колонки created_at, updated_at
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Разрешаем заполнять эти поля
     *
     * @var array
     */
    protected $fillable = [
        'day',
        'cure_id'
    ];

    /**
     * Медикаменты, которые использовались в этот день
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function nomenclatures()
    {
        return $this->belongsToMany(Nomenclature::class)->withPivot('amount')->withPivot('measure_id');
    }

    /**
     * Курс лечения, который включает этот день
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cure()
    {
        return $this->belongsTo(Cure::class);
    }

    /**
     * Комментарии дня курса лечения
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function getDayAttribute ()
    {
        return Carbon::parse($this->attributes['day']);
    }

}
