<?php

namespace App\Domain\User\Services;

use App\Domain\User\Entities\User;

class UserDomainService
{
    public function hashPassword(User $user): User
    {
        $user->password = bcrypt($user->password);
        return $user;
    }
}

