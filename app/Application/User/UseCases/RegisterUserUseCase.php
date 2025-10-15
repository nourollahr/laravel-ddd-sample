<?php

namespace App\Application\User\UseCases;

use App\Application\User\DTOs\RegisterUserDTO;
use App\Domain\User\Entities\User;
use App\Domain\User\Repositories\UserRepositoryInterface;
use App\Domain\User\Services\UserDomainService;
use App\Domain\User\Events\UserRegistered;

class RegisterUserUseCase
{
    public function __construct(
        private UserRepositoryInterface $repository,
        private UserDomainService $domainService
    ) {}

    public function execute(RegisterUserDTO $dto): User
    {
        $user = new User($dto->name, $dto->email, $dto->password);
        $user = $this->domainService->hashPassword($user);

        $saved = $this->repository->save($user);

        event(new UserRegistered($saved));

        return $saved;
    }
}
