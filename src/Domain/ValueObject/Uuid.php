<?php

namespace App\Domain\ValueObject;

use Ramsey\Uuid\Uuid as RamseyUuid;

final class Uuid
{
    private string $value;

    public function __construct(string $value)
    {
        if (!$this->isValid($value)) {
            throw new \InvalidArgumentException("Invalid UUID: $value");
        }
        $this->value = $value;
    }

    public function generate(): Uuid
    {
        return new Uuid(RamseyUuid::uuid4()->toString());
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function equals(Uuid $other): bool
    {
        return $this->value === $other->value;
    }

    public function __toString():string
    {
        return $this->value;
    }

    public function isValid(string $value): bool
    {
        return RamseyUuid::isValid($value);
    }
}