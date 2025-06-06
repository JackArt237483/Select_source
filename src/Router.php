<?php
namespace Src;

use Src\Controller\MainController;

require_once __DIR__ . '/Controller/MainController.php';

class Router {
    public function handleRequest() {
        if (isset($_GET['source']) && isset($_GET['page'])) {
            header('Content-Type: application/json');
            $controller = new MainController();
            $result = $controller->fetch($_GET['source'], (int)$_GET['page']);
            echo json_encode($result);
            return;
        }

        require_once __DIR__ . '../view/layout.php';
    }
}
