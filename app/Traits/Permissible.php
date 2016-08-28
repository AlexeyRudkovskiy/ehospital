<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 28.08.2016
 * Time: 14:00
 */

namespace App\Traits;

/**
 * Class Permissible
 *
 * Трэйт для работы с правами доступа
 * @author Alexey Rudkovskiy
 * @package App\Traits
 */
trait Permissible
{

    /**
     * Возвращает полное имя вида имямодели.действие.
     * Пример: хотим получить область видимости для модели Test и действия create.
     * Функция вернёт следующее: test.create
     *
     * @param string $action
     * @return string
     */
    public function getActionScope(string $action) : string
    {
        $className = mb_strtolower($this->getJustClassName());

        return "{$className}.{$action}";
    }

    /**
     * Возвращает лишь имя класса.
     * Так как self::class возвращает абсолютное имя класса(вместе с его пространством имён), разбиваем его по символу '\'
     * После этого берём последний элемент получившегося массива, так как знаем что имя класса записано в конце, и возвращаем его.
     *
     * @return string
     */
    public function getJustClassName() : string
    {
        $className = self::class;
        $className = explode('\\', $className);
        $className = array_pop($className);

        return $className;
    }

}