<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class NomenclatureSet extends Model
{

    use Searchable;

    public $timestamps = false;

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
