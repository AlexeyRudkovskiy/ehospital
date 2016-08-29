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
     * Разрешаем заполнять эти поля
     *
     * @var array
     */
    protected $fillable = [ 'comment', 'user_id' ];

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