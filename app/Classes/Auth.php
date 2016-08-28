<?php
/**
 * Created by PhpStorm.
 * User: alexeyrudkovskiy
 * Date: 28.07.16
 * Time: 13:46
 */

namespace App\Classes;

use App\User;

class Auth implements \App\Interfaces\Auth
{

    /**
     * @var User
     */
    private $current = null;

    /**
     * Id текущего пользователя
     *
     * @var int
     */
    private $currentId = 0;

    public function __construct()
    {
        if (\Session::has('user_id')) {
            $this->currentId = (int)(\Session::get('user_id', -1));
        }

        $this->current = User::find($this->currentId);
    }

    /**
     * Возвращает текущего пользователя
     *
     * @return User
     */
    public function user()
    {
        return $this->current;
    }

    /**
     * Возвращает true, если текущий пользователь не авторизирован. Иначе - false
     *
     * @return bool
     */
    public function isGuest()
    {
        return $this->current == null;
    }

    /**
     * Id текущего пользователя
     *
     * @return integer
     */
    public function id()
    {
        return $this->currentId;
    }

}