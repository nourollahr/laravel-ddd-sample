<?php

namespace App\Infrastructure\Repositories;

use App\Domain\User\Repositories\UserRepositoryInterface;
use App\Domain\User\Entities\User as DomainUser;
use App\Models\User as EloquentUser;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function save(DomainUser $user): DomainUser
    {
        $model = new EloquentUser();
        $model->name = $user->name;
        $model->email = $user->email;
        $model->password = $user->password;
        $model->save();

        return new DomainUser($model->name, $model->email, $model->password);
    }

    public function findByEmail(string $email): ?DomainUser
    {
        $model = EloquentUser::where('email', $email)->first();

        return $model ? new DomainUser($model->name, $model->email, $model->password) : null;
    }
}
