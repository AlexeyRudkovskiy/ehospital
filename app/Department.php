<?php

namespace App;

use App\Traits\Permissible;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Department
 *
 * @author Alexey Rudkovskiy
 * @package App
 */
class Department extends Model
{

    use Permissible;

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
        return $this->hasMany(User::class);
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
     * Руководитель отделения
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function leader()
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

}
