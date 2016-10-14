<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{

    protected $fillable = [
        'blood_group',
        'rh_factor'
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
    
}
