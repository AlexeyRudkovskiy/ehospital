<?php

namespace App\Classes;

use App\User;
use Illuminate\Broadcasting\Channel;

class UserChannel extends Channel
{

    /**
     * UserChannel constructor.
     * @param string $name
     * @param User $tag
     * @internal param int $id
     */
    public function __construct(string $name, User $user)
    {
        parent::__construct($user->id . '::' . $name);
    }

}