<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Measure extends Model
{

    protected $fillable = [
        'name',
        'amount',
        'nomenclature_Id'
    ];

    public function nomenclature()
    {
        return $this->belongsTo(Nomenclature::class);
    }

}
