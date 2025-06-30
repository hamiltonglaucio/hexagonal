<?php

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';
$containerBuilder = new ContainerBuilder();

$containerBuilder->addDefinitions(__DIR__ . '/../config/dependencies.php');

$container = $containerBuilder->build();

AppFactory::setContainer($container);

$app = AppFactory::create();

(require __DIR__ . '/../src/Adapter/In/Http/routes.php')($app);

$app->run();