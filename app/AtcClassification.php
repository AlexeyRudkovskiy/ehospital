<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AtcClassification
 *
 * @author Alexey Rudkovskiy
 * @package App
 */
class AtcClassification extends Model
{

    /**
     * Разрешаем заполнение этих полей
     *
     * @var array
     */
    protected $fillable = [
        'name_ua',
        'name_en',
        'parent_id'
    ];

    /**
     * Родительская категория
     *
     * @see \App\AtcClassification
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(AtcClassification::class);
    }

    /**
     * Медикаменты, у которых установленна эта классификация
     *
     * @see \App\Medicament
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function medicaments()
    {
        return $this->hasMany(Medicament::class);
    }

}