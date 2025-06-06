<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../src/Router.php';

use Src\Router;

$router = new Router();
$router->handleRequest();

