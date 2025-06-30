<?php

namespace App\Adapter\Out\Persistence;

use App\Domain\Entity\User;
use App\Domain\Repository\UserRepositoryInterface;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\Password;
use App\Domain\ValueObject\Role;
use Ramsey\Uuid\Uuid;

class UserRepositoryDatabaseAdapter implements UserRepositoryInterface
{
    public function __construct(
        private \PDO $pdo,
    ){
    }

    public function save(User $user): void
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO users (id, name, email, role, password) VALUES (:id, :name, :email, :role, :password)'
        );
        $stmt->execute([
            'id' => $user->getId()->toString(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'role' => $user->getRole(),
            'password' => $user->getPassword()?->getHash(),
        ]);
    }

    public function findByEmail($email): ?User
    {
        $email = $email->getValue();
        $stmt = $this->pdo->prepare(
            'SELECT * FROM users WHERE id = :email'
        );
        $stmt->execute(['email' => $email]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        return new User(
            Uuid::fromString($data['id']),
            $data['name'],
            new Email($data['email']),
            new Role($data['role']),
            $data['password'] ? new Password($data['password'], true) : null,
        );
    }
}