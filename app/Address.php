<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Адрес чего-либо.
 * Используется полиморфическая связь, благодаря чему адресс может иметь любая модель без изменения БД
 *
 * @author Alexey Rudkovskiy
 * @package App
 */
class Address extends Model
{

    /**
     * Разрешаем заполнять эти поля
     *
     * @var array
     */
    protected $fillable = [
        'country_id',
        'region',
        'city',
        'street',
        'house_number',
        'apartment'
    ];

    protected $with = [
        'country'
    ];

    /**
     * Устанавливаем полиморфическую зависимость
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function addressable()
    {
        return $this->morphTo();
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

}
