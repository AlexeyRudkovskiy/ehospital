<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListItem extends Model
{

    protected $fillable = [
        'data',
        'key',
        'patient_initial_inspection_id'
    ];

    public function patientFirstInspection()
    {
        return $this->belongsTo(Inspection::class);
    }

}
