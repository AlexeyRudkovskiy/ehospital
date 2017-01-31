<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class NomenclatureRequestMerged extends Model
{

    protected $fillable = [
        'requested', 'accepted', 'department_id', 'pharmacist_id'
    ];

    protected $casts = [
        'requested' => 'array',
        'accepted' => 'array'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nomenclatureRequests ()
    {
        return $this->hasMany(NomenclatureRequest::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pharmacist()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at']);
    }

}
