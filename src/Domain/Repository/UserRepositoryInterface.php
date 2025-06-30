<?php

namespace App\Domain\Repository;

use App\Domain\Entity\User;
use App\Domain\ValueObject\Email;

interface UserRepositoryInterface
{
    public function save(User $user);

    public function findByEmail(Email $email): ?User;
}