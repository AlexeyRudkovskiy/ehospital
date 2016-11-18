<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{

    public $fillable = [
        'status',
        'path'
    ];

    public function attachable()
    {
        return $this->morphTo('attachable');
    }

    public function deleteFile()
    {
        unset($this->path);
        return $this->delete();
    }

}
