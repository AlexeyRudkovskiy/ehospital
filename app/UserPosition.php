<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserPosition
 *
 * @author Alexey Rudkovskiy
 * @package App
 */
class UserPosition extends Model
{

    /**
     * Разрешаем заполнять этим поля
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Доступ к пользователям этой должности
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

}
