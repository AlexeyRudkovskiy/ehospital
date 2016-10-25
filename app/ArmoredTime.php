<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ArmoredTime extends Model
{

    /**
     * Отключаем колонки created_at, updated_at
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Доктор, к которому относится бронь
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function day()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return static
     */
    public function getTimeAttribute()
    {
        return Carbon::parse($this->attributes['time']);
    }

}
