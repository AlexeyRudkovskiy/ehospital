<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{

    protected $fillable = [
        'blood_group',
        'rh_factor',
        'diabetes',
        'allergic_history',
    ];

    protected $casts = [
        'rh_factor' => 'boolean'
    ];

    protected $with = [
        'bloodTransfusions'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bloodTransfusions()
    {
        return $this->hasMany(ListItem::class)->where('key', 'blood_transfusion');
    }

    public function getRhFactor()
    {
        $rhFactor = $this->rh_factor;
        $lang = $rhFactor ? 'management.label.patient.inspection.rhFactorPositive' : 'management.label.patient.inspection.rhFactorNegative';
        return trans($lang);
    }

}
