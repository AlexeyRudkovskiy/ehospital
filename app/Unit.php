<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Unit
 *
 * @author Alexey Rudkovskiy
 * @package App
 */
class Unit extends Model
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
        'text', 'scale', 'unit_id'
    ];

    /**
     * Родительская единица измерения
     *
     * @see \App\Unit
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    /**
     * Дочерние единицы измерения
     *
     * @see \App\Unit
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function units()
    {
        return $this->hasMany(Unit::class);
    }

    /**
     * Медикаменты, которые использую эту единицу измерений(basic_unit_id)
     *
     * @see \App\Nomenclature
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function basicNomenclatures()
    {
        return $this->hasMany(Nomenclature::class, 'basic_unit_id');
    }

    /**
     * Медикаменты, которые использую эту единицу измерений(base_unit_id)
     *
     * @see \App\Nomenclature
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function baseNomenclatures()
    {
        return $this->hasMany(Nomenclature::class, 'base_unit_id');
    }

    /**
     * Записи из истории медикаметов, которые имеют эту единицу измерения
     *
     * @see \App\NomenclatureHistory
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nomenclatureHistories()
    {
        return $this->hasMany(NomenclatureHistory::class);
    }

    /**
     * @deprecated
     * @todo Wil be removed
     */
    public function scaled()
    {

    }

}
