<?php

namespace App\Domain\ValueObject;

class Password
{
    private string $value;
    const MINLENGTH = 8;

    public function __construct(string $value, bool $alreadyHashed = false)
    {
        if ($alreadyHashed) {
            if (!$this->isHash($value)) {
                throw new \InvalidArgumentException('Password must be a valid hash.');
            }
            $this->value = $value;
        } else {
            if(!$this->isStrong($value)) {
                throw new \InvalidArgumentException('Password must be a strong password.');
            }
            $this->value = password_hash($value,  PASSWORD_BCRYPT);
        }
    }

    public function getHash(): string
    {
        return $this->value;
    }

    private function isStrong(string $password): bool
    {
        return strlen($password) >= self::MINLENGTH
            && preg_match('/[A-Z]/', $password)
            && preg_match('/[a-z]/', $password)
            && preg_match('/\d/', $password)
            && preg_match('/[^a-zA-Z0-9]/', $password);
    }

    private function isHash(string $password): bool
    {
        return preg_match('/^\$2[aby]\$.{56}$/', $password) === 1;
    }

    public function verify(string $plain): bool
    {
        return password_verify($plain, $this->value);
    }
}
