<?php

require_once "app/views/FlightsView.php";
require_once "app/models/FlightsModel.php";

class FlightsController {
    private $model;
    private $view;

    public function __construct($conn) {
        $this->model = new FlightsModel($conn);
        $this->view = new FlightsView();
    }

    public function index() {
        $this->view->render();
    }

    public function AddFlight(){
        $flight_number = $_POST['flight_number'];
        $departure = $_POST['departure'];
        $destination = $_POST['destination'];
        $departure_time = $_POST['departure_time'];
        $arrival_time = $_POST['arrival_time'];

        $errors = [];
        $errors[] = $this->validateFlightNumber($flight_number);
        $errors[] = $this->validateLocations($departure, $destination);
        $errors[] = $this->validateTime($departure_time, $arrival_time);

        $errors = array_filter($errors);

        if (!empty($errors)) {
            echo implode("<br>", $errors);
            exit();
        }
    

        echo $this->model->InsertFlight($flight_number, $departure, $destination, $departure_time, $arrival_time);
        exit();
    }

    private function validateFlightNumber($flight_number) {
        // Проверяем, что flight_number не пустое
        if (empty($flight_number)) {
            return "Flight number is required.";
        }
    
        // Проверяем формат номера рейса с помощью регулярного выражения
        if (!preg_match('/[a-zA-Z]+\d+/', $flight_number)) {
            return "Flight number format is invalid.";
        }
    
        // Если формат верен, возвращаем null
        return null;
    }

    private function validateLocations($departure, $destination) {
        // Проверяем, что departure не пустое
        if (empty($departure)) {
            return "Departure is required.";
        }
    
        // Проверяем, что destination не пустое
        if (empty($destination)) {
            return "Destination is required.";
        }
    
        // Проверяем, что departure и destination различны
        if ($departure === $destination) {
            return "Departure and destination should be different.";
        }
    
        // Возвращаем null, если проверка успешна
        return null;
    }

    private function validateTime($departure_time, $arrival_time) {
        // Проверяем, что время отправления не пустое
        if (empty($departure_time)) {
            return "Departure time is required.";
        }

        // Проверяем, что время прибытия не пустое
        if (empty($arrival_time)) {
            return "Arrival time is required.";
        }
    
        // Проверяем формат времени отправления и времени прибытия
        if (!strtotime($departure_time) || !strtotime($arrival_time)) {
            return "Invalid time format.";
        }
    
        // Проверяем, что время отправления меньше времени прибытия
        if (strtotime($departure_time) >= strtotime($arrival_time)) {
            return "Departure time should be before arrival time.";
        }
    
        // Возвращаем null, если проверка успешна
        return null;
    }
    
}