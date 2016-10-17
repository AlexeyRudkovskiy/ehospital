<?php

namespace App\Policies;

use App\Contractor;
use App\User;

class ContractorPolicy extends DefaultPolicy
{

    public function store(User $user, Contractor $contractor, $access)
    {
        return $access;
    }

}