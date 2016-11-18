<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NomenclatureRequest extends Model
{

    protected $fillable = [
        'requested',
        'accepted',

        'cure_id',
        'done',

        'ready',

        'doctor_id',
        'head_nurse_id',
        'chief_medical_officer_id',
        'pharmacist_id'
    ];

    protected $casts = [
        'requested' => 'array',
        'accepted' => 'array',
        'done' => 'boolean',
        'ready' => 'boolean'
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cure()
    {
        return $this->belongsTo(Cure::class);
    }

    public function file()
    {
        return $this->morphOne(File::class, 'attachable');
    }

    public function requestedData()
    {
        $requested = $this->requested;
        $requestedData = [];
        $accepted = $this->accepted ?? [];

        foreach ($requested as $key => $value) {
            $key = explode('_', $key);
            $nomenclature = Nomenclature::find($key[0]);
            $requestedItem = (object)[
                'nomenclature' => $nomenclature,
                'amount' => $value,
                'unit' => Unit::find($key[1]),
                'balance' => $nomenclature->balance()
            ];

            if (array_key_exists($nomenclature->id, $accepted)) {
                $requestedItem->accepted = number_format($accepted[$nomenclature->id]['amount'], 2);
                $requestedItem->accepted_unit_id = $accepted[$nomenclature->id]['unit_id'];
            } else {
                $requestedItem->accepted = '';
                $requestedItem->accepted_unit_id = -1;
            }

            array_push($requestedData, $requestedItem);
        }

        return $requestedData;
    }

}
