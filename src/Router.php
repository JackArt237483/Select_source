<?php
namespace Src;

use Src\Controller\MainController;

class Router {
    private $controller;

    public function __construct(array $apiKeys) {
        $this->controller = new MainController($apiKeys);
    }

    public function handleRequest() {
        $source = $_GET['source'] ?? 'news';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $fetch = isset($_GET['fetch']);

        $this->controller->index($source, $page, $fetch);
    }
}
