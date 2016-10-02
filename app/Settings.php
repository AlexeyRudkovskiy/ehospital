<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{

    protected $fillable = [ 'notifications' ];

    protected $casts = [
        'notifications' => 'json'
    ];

}
