<?php

namespace App;

use App\Traits\Permissible;
use App\Traits\RevisionsTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Test
 *
 * @deprecated
 * @author Alexey Rudkovskiy
 * @package App
 */
class Test extends Model
{

    use RevisionsTrait;
    use Permissible;

    protected $fillable = [ 'text', 'priority' ];

    public function comments ()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

}
