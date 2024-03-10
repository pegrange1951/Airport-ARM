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

        echo $this->model->InsertPassenger($full_name, $passport_number, $flight_number, $seat_number);

        header("Location: /");
        exit();
    }
}