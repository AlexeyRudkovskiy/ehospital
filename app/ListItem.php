<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListItem extends Model
{

    /**
     * Отключаем колонки created_at, updated_at
     *
     * @var bool
     */
    public $timestamps = false;

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
