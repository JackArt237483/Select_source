<?php

use Src\Router;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../src/Router.php';

$router = new Router();
$router->handleRequest();

