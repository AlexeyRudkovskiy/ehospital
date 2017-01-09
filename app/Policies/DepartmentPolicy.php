<?php
/**
 * Created by PhpStorm.
 * User: alexeyrudkovskiy
 * Date: 17.10.16
 * Time: 14:34
 */

namespace App\Policies;


use App\Department;
use App\User;

class DepartmentPolicy extends DefaultPolicy
{

    /**
     * @param User $user
     * @param Department $department
     * @param $access
     */
    public function index(User $user, Department $department, $access)
    {
        return $access;
    }

    public function store(User $user, Department $department, $access)
    {
        return $access;
    }

}