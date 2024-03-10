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

        echo $this->model->InsertFlight($flight_number, $departure, $destination, $departure_time, $arrival_time);

        header("Location: /");
        exit();
    }
}