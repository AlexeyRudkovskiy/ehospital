<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CalendarDay
 *
 * @author Alexey Rudkovskiy
 * @package App
 */
class CalendarDay extends Model
{

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
    public function medicaments()
    {
        return $this->belongsToMany(Medicament::class);
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

}
