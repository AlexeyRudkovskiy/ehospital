<?php

namespace App\Policies;

use App\Organization;
use App\User;

class OrganizationPolicy {

    public function create(User $user)
    {
        dd($user);
    }

    /**
     * @param User $user
     * @param Organization $organization
     * @param $access
     *
     * @return boolean
     */
    public function store(User $user, Organization $organization, $access)
    {
        return $access;
    }

    public function update(User $user, Organization $organization, $access)
    {
        return $access;
    }

}