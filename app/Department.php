<?php

namespace App;

use App\Traits\Permissible;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 * Class Department
 *
 * @author Alexey Rudkovskiy
 * @package App
 */
class Department extends Model
{

    use Permissible;
    use Searchable;

    /**
     * Отключаем колонки created_at, updated_at
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'name',
        'department_code',
        'beds_amount',
        'beds_amount_in_repair',
        'female_beds_amount',
        'male_beds_amount',
        'leader_id',
        'chief_medical_officer_id',
        'organization_id'
    ];

    /**
     * Пользователи, которые относятся к этому отделению
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class)->orderBy('lastName')->orderBy('firstName')->orderBy('middleName');
    }

    /**
     * Курсы лечения, протекающие в этом отделении
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cures()
    {
        return $this->hasMany(Cure::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function storage()
    {
        return $this->hasMany(DepartmentStorage::class, 'department_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nomenclatureSets()
    {
        return $this->hasMany(NomenclatureSet::class);
    }

    public function nomenclatureRequests()
    {
        return $this->hasManyThrough(NomenclatureRequest::class, Cure::class);
    }

    public function patients()
    {
        $patientsIds = $this->cures()
                            ->select('patient_id')
                            ->whereNull('discharge_date')
                            ->distinct('patient_id')
                            ->get()
                            ->map(function (Cure $cure) {
                                return $cure->patient_id;
                            });
        return Patient::whereIn('id', $patientsIds)->orderBy('name', 'asc')->paginate(config('eh.pagination.limit'), ['*'], 'department_patients_page');
    }

    /**
     * Руководитель отделения
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function leader()
    {
        return $this->belongsTo(User::class);
    }

    public function headNurse()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chiefMedicalOfficer()
    {
        return $this->belongsTo(User::class, 'chief_medical_officer_id');
    }

    /**
     * Организация, в которой находится это тделение
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function calculateAmountToRequest(Nomenclature $nomenclature = null, $need = 0)
    {
        if ($nomenclature == null) {
            throw new \InvalidArgumentException('$nomenclature can\'t be equals null');
        }

        $storageRecord = $this->storage()->whereNomenclatureId($nomenclature->id);

        if ($storageRecord->count() < 1) {
            return [
                'storage' => $need,
                'in_stock' => 0
            ];
        } else {
            $storageRecord = $storageRecord->first();
            if ($storageRecord->data['in_stock'] > $need) {
                return [
                    'storage' => 0,
                    'in_stock' => $need
                ];
            } else {
                return [
                    'storage' => $need - $storageRecord->data['in_stock'],
                    'in_stock' => $storageRecord->data['in_stock']
                ];
            }
        }
    }

    public function nomenclatureIncome(Nomenclature $nomenclature, $amount)
    {
        if ($this->storage()->whereNomenclatureId($nomenclature->id)->count() > 0) {
            $storage = $this->storage()->whereNomenclatureId($nomenclature->id)->first();
            $data = $storage->data;

            $data['in_stock'] += $amount;

            $storage->update([
                'data' => $data
            ]);

            return $data;
        } else {
            $data = [
                'in_stock' => $amount,
                'armored' => 0
            ];
            $this->storage()->create([
                'nomenclature_id' => $nomenclature->id,
                'data' => $data
            ]);

            return  $data;
        }
    }

    public function armorNomenclature(Nomenclature $nomenclature, float $amount)
    {
        if ($this->storage()->whereNomenclatureId($nomenclature->id)->count() > 0) {
            $storage = $this->storage()->whereNomenclatureId($nomenclature->id)->first();
            $data = $storage->data;
            if ($data['in_stock'] > $amount) {
                $data['in_stock'] -= $amount;
                $data['armored'] += $amount;

                $storage->update([
                    'data' => $data
                ]);
                return $data;
            }
            return null;
        } else {
            return null;
        }
    }

}
