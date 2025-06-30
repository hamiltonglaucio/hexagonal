<?php

use App\Adapter\In\Http\Controllers\UserController;
use Slim\App;

return function (App $app) {
    $app->get('/', [UserController::class, 'index']);
    $app->post('/users', [UserController::class, 'register']);
};