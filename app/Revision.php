<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Revision
 *
 * @author Alexey Rudkovskiy
 * @package App
 */
class Revision extends Model
{

    /**
     * Разрешаем заполнять эти поля
     *
     * @var array
     */
    protected $fillable = [
        'changedFrom',
        'changedTo',
        'made_by_id',
        'keys'
    ];

    /**
     * Говорим фреймворку, что нужно автоматически конвертировать поля в нужный нам тип.
     * В данном случае будем конвертировать при чтении поля changedFrom и changedTo в JSON.
     * При записи же эти поля будут преобразованы в строку.
     *
     * @var array
     */
    protected $casts = [
        'changedFrom' => 'json',
        'changedTo' => 'json'
    ];

    protected $diff = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function revisionable()
    {
        return $this->morphTo();
    }

    /**
     * Комментарии
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Кем было сделано
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function madeBy()
    {
        return $this->belongsTo(User::class, 'made_by_id');
    }

    /**
     * Возвращает объект, который содержит ключи diff[from, to], author, date, comments.
     * По ключу from доступны данные, с которых были произведены изменения.
     * По ключу to доступны данные, на которые были изменены/
     *
     * author - автор изменений(кем были произведены).
     * date - дата изменений
     * comments - комментарии
     *
     * @return object
     */
    public function getDiff()
    {
        if ($this->diff != []) {
            return (object)($this->diff);
        }

        $from = json_decode($this->attributes['changedFrom']);
        $to = json_decode($this->attributes['changedTo']);
        $diff = [];
        foreach ($from as $key => $val) {
            $diff[$key] = [
                'from' => $val,
                'to' => $to->{$key}
            ];
        }

        $this->diff = [
            'diff' => $diff,
            'author' => $this->madeBy,
            'date' => $this->created_at,
            'comments' => $this->comments
        ];

        return (object)($this->diff);
    }

}
