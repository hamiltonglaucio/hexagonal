<?php

use App\Adapter\In\Http\Controllers\UserController;
use App\Adapter\Out\Persistence\UserRepositoryDatabaseAdapter;
use App\Application\UseCase\RegisterUserUseCase;
use App\Domain\Repository\UserRepositoryInterface;
use function DI\autowire;

return [
    PDO::class => function () {
        return new PDO('mysql:host=mysql;dbname=app', 'app', 'app');
    },
    UserRepositoryInterface::class => autowire(UserRepositoryDatabaseAdapter::class),
    RegisterUserUseCase::class => autowire(),
    UserRepositoryDatabaseAdapter::class => autowire(),
    UserController::class => autowire(),
];