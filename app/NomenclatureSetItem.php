<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NomenclatureSetItem extends Model
{

    protected $fillable = [
        'amount', 'nomenclature_id', 'nomenclature_set_id', 'unit_id'
    ];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function set()
    {
        return $this->belongsTo(NomenclatureSet::class, 'nomenclature_set_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nomenclature()
    {
        return $this->belongsTo(Nomenclature::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

}
