<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CureStatus extends Model
{

    /**
     * Отключаем колонки created_at, updated_at
     *
     * @var bool
     */
    public $timestamps = false;

}
