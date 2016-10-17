<?php

namespace App;

use App\Traits\Permissible;
use App\Traits\RevisionsTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Contractor
 *
 * @author Alexey Rudkovskiy
 * @package App
 */
class Contractor extends Model
{

    use RevisionsTrait;
    use Permissible;

    /**
     * Разрешаем заполнять эти поля
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'fullName',
        'type',
        'edrpou',
        'description',
        'phone',
        'contractor_group_id'
    ];

    /**
     * Комментарии записи
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Группа контрагентов, в которой находится этот контрагент
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(ContractorGroup::class, 'contractor_group_id');
    }

    /**
     * @return mixed
     */
    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable')->orderBy('id', 'desc');
    }

}
