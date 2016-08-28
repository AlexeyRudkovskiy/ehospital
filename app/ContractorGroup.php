<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ContractorGroup
 *
 * @author Alexey Rudkovskiy
 * @package App
 */
class ContractorGroup extends Model
{

    /**
     * Разрешаем заполнять эти поля
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'parent_id'
    ];

    /**
     * Родительская категория
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(ContractorGroup::class, 'parent_id');
    }

    /**
     * Контрагенты, которые принадлежат этой категории
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contractors()
    {
        return $this->hasMany(Contractor::class);
    }

}
