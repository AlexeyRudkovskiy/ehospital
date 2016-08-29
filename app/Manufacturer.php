<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Manufacturer
 *
 * @author Alexey Rudkovskiy
 * @package App
 */
class Manufacturer extends Model
{

    /**
     * Разрешаем заполнять эти поля
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Медикаменты, которые производит этот производитель
     *
     * @see \App\Medicament
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function medicaments()
    {
        return $this->hasMany(Medicament::class);
    }

    /**
     * Адресс
     *
     * @see \App\Address
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

}
