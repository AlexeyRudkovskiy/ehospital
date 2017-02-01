<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class SourceOfFinancing extends Model
{

    use Searchable;

    /**
     * Отключаем колонки created_at, updated_at
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

}
