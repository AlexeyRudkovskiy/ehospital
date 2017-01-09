<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Permission
 *
 * @author Alexey Rudkovskiy
 * @package App
 */
class Permission extends Model
{

    /**
     * Отключаем колонки created_at, updated_at
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Разрешаем автоматическое заполнение полей name и map
     *
     * @var array
     */
    protected $fillable = [ 'name', 'map', 'sidebar' ];

    const PHARMACIST = 2;

    const CHIEF_MEDICAL_OFFICER = 3;

    /**
     * Преобразуем нужные поля к нужным типам
     *
     * @var array
     */
    protected $casts = [
        'map' => 'array',
        'sidebar' => 'array'
    ];

    /**
     * Проверяет, имеет ли данная группа доступ на что-либо
     *
     * @param string $what
     * @return bool mixed
     */
    public function granted($what)
    {
        if (gettype($this->map) === 'string') {
            $this->map = json_decode($this->map, true);
        }
        if (!array_has($this->map, $what)) {
            return false;
        }
        $value = array_get($this->map, $what);
        return $value;
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

}
