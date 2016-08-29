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
     * Разрешаем автоматическое заполнение полей name и map
     *
     * @var array
     */
    protected $fillable = [ 'name', 'map' ];

    /**
     * Преобразуем нужные поля к нужным типам
     *
     * @var array
     */
    protected $casts = [
        'map' => 'array'
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

}
