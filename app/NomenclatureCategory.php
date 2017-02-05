<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class NomenclatureCategory extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'name', 'parent_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childs()
    {
        return $this->hasMany(NomenclatureCategory::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(NomenclatureCategory::class);
    }

    public function scopeParentless(Builder $query)
    {
        return $query->whereParentId(null);
    }

}
