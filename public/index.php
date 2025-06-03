<?php
// public/index.php — точка входа
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../src/Service/NewsSourse.php';
require_once __DIR__ . '/../src/Service/WeatherSourse.php';

use Src\Router;

$apiKeys = [
    'news' => NEWS_API_KEY,
    'weather' => WEATHER_API_KEY,
];

$router = new Router($apiKeys);
$router->handleRequest();
