<?php
/**
 * Created by PhpStorm.
 * User: HOME
 * Date: 28.08.2016
 * Time: 17:42
 */

namespace App\Policies;


use App\Test;
use App\User;

class TestPolicy
{
    public function view (User $user, Test $test) {
        return true;
    }
}