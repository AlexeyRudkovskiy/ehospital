<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Comment
 *
 * @author Alexey Rudkovskiy
 * @package App
 */
class Comment extends Model
{

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
    protected $fillable = [ 'text', 'user_id' ];

    protected $with = [ 'user' ];

    protected $hidden = [ 'id', 'commentable_type', 'commentable_id' ];

    /**
     * Устанавливаем полиморфическую связь
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function commentable()
    {
        return $this->morphTo('commentable');
    }

    /**
     * Автор комментария
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user ()
    {
        return $this->belongsTo(User::class);
    }

}
