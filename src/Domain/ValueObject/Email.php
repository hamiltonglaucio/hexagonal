<?php

namespace App\Domain\ValueObject;

class Email
{
    private string $value;

    public function __construct(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("Invalid email: $email");
        }
        $this->value = strtolower($email);
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function equals(Email $email): bool
    {
        return $this->value === $email->getValue();
    }

    public function __toString():string
    {
        return $this->value;
    }
}