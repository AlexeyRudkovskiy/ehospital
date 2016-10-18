<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Agreement extends Model
{

    protected $fillable = [
        'from',
        'until',
        'price'
    ];

    protected $casts = [
        'until' => 'date',
        'from' => 'date'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function agreementable()
    {
        return $this->morphTo();
    }

    /**
     * @return string
     */
    public function getFromAttribute()
    {
        return Carbon::parse($this->attributes['from'])->format('Y-m-d');
    }

    /**
     * @return string
     */
    public function getUntilAttribute()
    {
        return Carbon::parse($this->attributes['until'])->format('Y-m-d');
    }

}
