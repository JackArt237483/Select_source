<?php
namespace Src;

use Src\Controller\MainController;

// Include the main controller file
require_once __DIR__ . '/Controller/MainController.php';

class Router {
    /**
     * Handle the incoming HTTP request.
     */
    public function handleRequest() {
        // Check if 'source' and 'page' parameters are present in the query string
        if (isset($_GET['source']) && isset($_GET['page'])) {
            // Set the response header to return JSON
            header('Content-Type: application/json');

            // Create an instance of the controller and fetch data
            $controller = new MainController();
            $result = $controller->fetch($_GET['source'], (int)$_GET['page']);

            // Return the result as a JSON response
            echo json_encode($result);
            return;
        }

        // If parameters are not present, load the default layout view
        require_once __DIR__ . '../view/layout.php';
    }
}
