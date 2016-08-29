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
     * @see \App\Medicament
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function basicMedicaments()
    {
        return $this->hasMany(Medicament::class, 'basic_unit_id');
    }

    /**
     * Медикаменты, которые использую эту единицу измерений(base_unit_id)
     *
     * @see \App\Medicament
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function baseMedicaments()
    {
        return $this->hasMany(Medicament::class, 'base_unit_id');
    }

    /**
     * Записи из истории медикаметов, которые имеют эту единицу измерения
     *
     * @see \App\MedicamentHistory
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function medicamentHistories()
    {
        return $this->hasMany(MedicamentHistory::class);
    }

    /**
     * @deprecated
     * @todo Wil be removed
     */
    public function scaled()
    {

    }

}
