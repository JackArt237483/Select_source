
<?php
namespace Src;

require_once __DIR__ . '/Controller/MainController.php';

class Router {
    public function handleRequest() {
        if (isset($_GET['source']) && isset($_GET['page'])) {
            header('Content-Type: application/json');
            $controller = new \Src\Controller\MainController();
            echo $controller->fetchData($_GET['source'], $_GET['page']);
            return;
        }

        require_once __DIR__ . '/../view/layout.php';
    }
}