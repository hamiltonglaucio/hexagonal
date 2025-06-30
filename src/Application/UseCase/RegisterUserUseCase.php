<?php

namespace App\Application\UseCase;

use App\Domain\Entity\User;
use App\Domain\Repository\UserRepositoryInterface;

class RegisterUserUseCase
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ){
    }

    public function execute(User $user): void
    {
        $exists = $this->userRepository->findByEmail($user->getEmail());
        if ($exists) {
            throw new \DomainException("User already exists");
        }

        var_dump($user);
        $this->userRepository->save($user);
    }
}