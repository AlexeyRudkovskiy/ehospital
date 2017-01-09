<?php

namespace App\Policies;


class DefaultPolicy
{

    function __call($name, $arguments)
    {
        if (count($arguments) == 3) {
            return array_pop($arguments);
        }
        return false;
    }

}