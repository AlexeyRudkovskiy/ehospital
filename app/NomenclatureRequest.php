<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NomenclatureRequest extends Model
{

    protected $fillable = [
        'requested',
        'accepted',

        'doctor_id',
        'head_nurse_id',
        'chief_medical_officer_id',
        'pharmacist_id'
    ];

    protected $casts = [
        'requested' => 'array',
        'accepted' => 'array'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function headNurse()
    {
        return $this->belongsTo(User::class, 'head_nurse_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chiefMedicalOfficer()
    {
        return $this->belongsTo(User::class, 'chief_medical_officer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pharmacist()
    {
        return $this->belongsTo(User::class, 'pharmacist_id');
    }

}
