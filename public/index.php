<?php
// Entry point of the application

declare(strict_types=1);

use Src\Router;


require_once __DIR__ . '/../vendor/autoload.php'; // Подключаем автозагрузчик Composer
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../src/Router.php';

$router = new Router();
$router->handleRequest();
