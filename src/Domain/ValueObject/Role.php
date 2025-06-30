<?php

namespace App\Domain\ValueObject;

class Role
{
    public function __construct(
        private RoleType $type
    ){
    }

    public function getType(): RoleType
    {
        return $this->type;
    }

    public function isStudent(): bool
    {
        return $this->type === RoleType::STUDENT;
    }

    public function isTeacher(): bool
    {
        return $this->type === RoleType::TEACHER;
    }

    public function isAdmin(): bool
    {
        return $this->type === RoleType::ADMIN;
    }

    public function equals(Role $other): bool
    {
        return $this->type === $other->getType();
    }

    public function __toString(): string
    {
        return $this->type->value;
    }
}
