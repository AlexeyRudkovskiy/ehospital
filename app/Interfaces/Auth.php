<?php

namespace App\Interfaces;
use App\User;

/**
 * Class Auth
 *
 * Класс для работы с текущим авторизированным пользователем
 *
 * @package App\Interfaces
 */
interface Auth
{

    /**
     * Возвращает текущего пользователя
     *
     * @return User
     */
    public function user();

    /**
     * Возвращает true, если текущий пользователь не авторизирован. Иначе - false
     *
     * @return bool
     */
    public function isGuest();

    /**
     * Id текущего пользователя
     *
     * @return integer
     */
    public function id();

}