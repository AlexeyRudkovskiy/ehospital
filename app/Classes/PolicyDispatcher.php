<?php

namespace App\Classes;


use App\Interfaces\PolicyDispatcherInterface;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Mockery\CountValidator\Exception;

/**
 * Class PolicyDispatcher
 *
 * @author Alexey Rudkovskiy
 * @see \App\Interfaces\PolicyDispatcherInterface
 * @package App\Classes
 */
class PolicyDispatcher implements PolicyDispatcherInterface
{

    /**
     * @var array
     */
    protected $policies = [];

    /**
     * Авторизированный пользоватедб
     *
     * @var User
     */
    protected $user = null;

    /**
     * Инициализация PolicyDispatcherInterface
     *
     * @return mixed
     */
    public function init() : PolicyDispatcherInterface
    {
        $this->user = auth()->user();
        return $this;
    }

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
    public function dispatch(Model $model, string $action) : bool
    {
        /*
         * Проверяем, есть ли у текущего пользователя права на доступ к группу прав.
         * Например имеем таблицу прав следующего вида:
         * {
         *     'post': [
         *         'edit'
         *     ]
         * }
         * Если в $action придёт edit то перейдём к следующей проверке
         * Если же будет read, то, как видим выше, у нас нет доступа к этому, следовательно функция вернёт false
         */
        if ($access = $this->user->granted($model, $action) !== false) {
            /*
             * Делим имя на несколько частей по точкам и берёт последний элемент.
             * Пример: имеем следующий $action: post.edit. После разбивки получим ['post', 'edit'].
             * Взяв последний элемент получаем edit.
             */
            $action = explode('.', $action);
            $action = array_pop($action);

            if (method_exists($this->policies[get_class($model)], $action)) {
                /*
                 * Вызываем метод, полученный способом описанным выше у политики, которая ссовпадает с полным именем класса цели.
                 * Пример полного имёт класса: App\User, App\Organization\ App\Http\Controllers\HomeController.
                 * В качестве аргументов передаём текущего пользователя, который хранится в переменной $user и саму цель проверки.
                 * Важно помнить, что текущим пользователем не обязательно может быть текущий авторизованный пользователь.
                 * Им может так же быть любой другой, установленный с помощью функции setUser()
                 */
                return call_user_func_array([
                    $this->policies[get_class($model)], $action
                ], [ $this->user, $model, $access ]);
            } else {
                return $access;
            }
        }
        return false;
    }

    /**
     * Register policy and his target
     *
     * @param string $target
     * @param $policy
     * @return PolicyDispatcherInterface
     */
    public function register(string $target, $policy) : PolicyDispatcherInterface
    {
        $this->policies[$target] = $policy;
        return $this;
    }

    /**
     * Установка пользователья, для которого необходимо выполнить проверку
     *
     * @param User $user
     * @return mixed
     */
    public function setUser(User $user) : PolicyDispatcherInterface
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Получаем пользователя, от имени которого проверяем права доступа
     *
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * Восстаналивает значения текущего пользователя авторизованным пользователем
     *
     * @return PolicyDispatcherInterface
     */
    public function restoreUser() : PolicyDispatcherInterface
    {
        $this->user = auth()->user();
        return $this;
    }

}