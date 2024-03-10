<?php
class Router {

    public function route() {
        $uri = $_SERVER['REQUEST_URI'];

        include 'app/controllers/FlightsController.php';
        include 'app/controllers/PassengersController.php';

        include "app/core/Database.php";
        
        $db = new Database();

        include 'includes/sidebar.php';

        switch ($uri) {
            case '/':
                echo 'Hello world!';
                break;

            case '/flights':
                $controller = new FlightsController($db->conn);
                $controller->index();
                break;
            
            case '/addflight':
                $controller = new FlightsController($db->conn);
                $controller->AddFlight();
                break;
    
            case '/passengers':
                $controller = new PassengersController($db->conn);
                $controller->index();
                break;

            case '/addpassenger':
                $controller = new PassengersController($db->conn);
                $controller->AddPassenger();
                break;

            default:
                // Ошибка 404
                header('HTTP/1.0 404 Not Found');
                echo 'Страница не найдена';
                break;
        }
    }
}