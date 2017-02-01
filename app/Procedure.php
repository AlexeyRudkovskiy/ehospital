<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Procedure extends Model
{

    use Searchable;

    protected $fillable = [
        'name'
    ];

}
