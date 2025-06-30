<?php

namespace App\Domain\Entity;

use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\Password;
use App\Domain\ValueObject\Role;
use Ramsey\Uuid\UuidInterface;

class User
{
    public function __construct(
        private UuidInterface $id,
        private string $name,
        private Email $email,
        private Role $role,
        private ?Password $password
    ){
        if (empty(trim($name))){
            throw new \InvalidArgumentException("Name cannot be empty");
        }
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getRole(): Role
    {
        return $this->role;
    }

    public function getPassword(): ?Password
    {
        return $this->password;
    }
}