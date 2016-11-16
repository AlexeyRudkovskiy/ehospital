<?php

namespace App;

use App\Traits\Permissible;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Organization
 *
 * @author Alexey Rudkovskiy
 * @package App
 */
class Organization extends Model
{

    use Permissible;

    /**
     * Отключаем колонки created_at, updated_at
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Разрешаем автоматическое заполнение полей name и type
     *
     * @var array
     */
    protected $fillable = [ 'name', 'type' ];

    /**
     * Отделения, находящиеся в этой организации
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function departments()
    {
        return $this->hasMany(Department::class)->orderBy('name', 'ask');
    }

    /**
     * Пользователи, работающие в этой ораганизации
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class)->orderBy('id', 'desc');
    }



}
