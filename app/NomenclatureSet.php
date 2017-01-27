<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NomenclatureSet extends Model
{

    protected $fillable = [
        'name', 'department_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(NomenclatureSetItem::class, 'nomenclature_set_id');
    }

}
