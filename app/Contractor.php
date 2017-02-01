<?php

namespace App;

use App\Traits\Permissible;
use App\Traits\RevisionsTrait;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

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
    use Searchable;

    /**
     * Отключаем колонки created_at, updated_at
     *
     * @var bool
     */
    public $timestamps = false;

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
        'contractor_group_id',
        'group'
    ];

    protected $with = [
        'addresses',
        'agreements'
    ];

    /**
     * Комментарии записи
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->orderBy('id', 'desc');
    }

    /**
     * Группа контрагентов, в которой находится этот контрагент
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
//    public function group()
//    {
//        return $this->belongsTo(ContractorGroup::class, 'contractor_group_id')->orderBy('id', 'desc');
//    }

    /**
     * @return mixed
     */
    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable')->orderBy('id', 'desc')->orderBy('id', 'desc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function agreements () {
        return $this->morphMany(Agreement::class, 'agreementable')->orderBy('id', 'desc');
    }

}
