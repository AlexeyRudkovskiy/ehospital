<?php

namespace App\Traits;

use App\Revision;

trait RevisionsTrait
{

    // TODO: Empty

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function revisions()
    {
        return $this->morphMany(Revision::class, 'revisionable')->orderBy('id', 'desc');
    }

}