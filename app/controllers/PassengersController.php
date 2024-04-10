<?php

require_once "app/views/PassengersView.php";
require_once "app/models/PassengersModel.php";


class PassengersController {
    private $model;
    private $view;

    public function __construct($conn) {
        $this->model = new PassengersModel($conn);
        $this->view = new PassengersView();
    }

    public function index() {
        $this->view->render();
    }

    public function AddPassenger(){
        $full_name = $_POST['full_name'];
        $passport_number = $_POST['passport_number'];
        $flight_number = $_POST['flight_number'];
        $seat_number = $_POST['seat_number'];

        // Проверяем каждое поле
        $errors = [];
        $errors[] = $this->validateFullName($full_name);
        $errors[] = $this->validatePassportNumber($passport_number);
        $errors[] = $this->validateFlightNumber($flight_number);
        $errors[] = $this->validateSeatNumber($seat_number);

        // Удаляем возможные пустые значения из массива ошибок
        $errors = array_filter($errors);

        // Если есть ошибки, выводим их
        if (!empty($errors)) {
            echo implode("<br>", $errors);
            exit();
        }

        echo $this->model->InsertPassenger($full_name, $passport_number, $flight_number, $seat_number);
        exit();
    }

    private function validateFullName($full_name) {
        if (empty($full_name)) {
            return "Full name is required.";
        }
        
        // Разделяем строку на слова
        $words = explode(' ', $full_name);
        
        // Проверяем количество слов
        $wordCount = count($words);
        if ($wordCount < 2 || $wordCount > 3) {
            return "Full name should consist of 2 or 3 words.";
        }

        // Проверяем, что full_name содержит только буквы и пробелы
        if (!preg_match('/^[\p{L}\s]+$/u', $full_name)) {
            return "Full name should contain only letters and spaces.";
        }
            
        return null;
    }
        
    private function validatePassportNumber($passport_number) {
        if (empty($passport_number)) {
            return "Passport number is required.";
        }
        // Дополнительные проверки, если необходимо
        return null;
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
    private function validateSeatNumber($seat_number) {
        if (empty($seat_number)) {
            return "Seat number is required.";
        }
        
        // Проверяем, является ли seat_number числом
        if (!is_numeric($seat_number)) {
            return "Seat number should be a number.";
        }
        
        // Проверяем, что seat_number меньше 999
        if ($seat_number >= 999) {
            return "Seat number should be less than 999.";
        }
        
        return null;
    }    
}