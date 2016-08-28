<?php

namespace App\Interfaces;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface PolicyDispatcherInterface
 *
 * @authort Alexey Rudkovskiy
 * @package App\Interfaces
 */
interface PolicyDispatcherInterface
{

    /**
     * Инициализация PolicyDispatcherInterface
     *
     * @return mixed
     */
    public function init() : PolicyDispatcherInterface;

    /**
     * Проверка правила $action для модели $model.
     * В качестве исполнителя(того, от чьего имени будет выполняться проверка) используется авторизованный пользователь
     * или заданный с помощью метода setUser
     *
     * @param Model $model
     * @param string $action
     * @see \App\Interfaces\PolicyDispatcherInterface::setUser()
     * @return bool|mixed
     */
    public function dispatch(Model $model, string $action) : bool;

    /**
     * Register policy and his target
     *
     * @param string $target
     * @param $policy
     * @return PolicyDispatcherInterface
     */
    public function register(string $target, $policy) : PolicyDispatcherInterface;

    /**
     * Установка пользователья, для которого необходимо выполнить проверку
     *
     * @param User $user
     * @return PolicyDispatcherInterface
     */
    public function setUser(User $user) : PolicyDispatcherInterface;

    /**
     * Восстаналивает значения текущего пользователя авторизованным пользователем
     *
     * @return PolicyDispatcherInterface
     */
    public function restoreUser() : PolicyDispatcherInterface;

}