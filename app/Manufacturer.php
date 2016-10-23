<?php

namespace App;

use App\Traits\RevisionsTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Manufacturer
 *
 * @author Alexey Rudkovskiy
 * @package App
 */
class Manufacturer extends Model
{

    use RevisionsTrait;

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
     * @see \App\Nomenclature
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nomenclatures()
    {
        return $this->hasMany(Nomenclature::class);
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
