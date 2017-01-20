<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepartmentStorage extends Model
{

    protected $fillable = [
        'nomenclature_id', 'department_id', 'data'
    ];

    protected $casts = [
        'data' => 'json'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nomenclature()
    {
        return $this->belongsTo(Nomenclature::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

}
