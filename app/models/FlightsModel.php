<?php

class FlightsModel {
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function InsertFlight($flight_number, $departure, $destination, $departure_time, $arrival_time) {
        $sql = "INSERT INTO flights (flight_number, departure, destination, departure_time, arrival_time) VALUES (?, ?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($sql);

        if(!$stmt){
            die("Ошибка подготовки запроса" . $this->conn->error);
        }

        $stmt->bind_param("sssss", $flight_number, $departure, $destination, $departure_time, $arrival_time);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo "Запись успешно добавлена.";
            } else {
                echo "Запись не добавлена (возможно, конфликт с существующими данными).";
            }
        } else {
            echo "Ошибка выполнения запроса: " . $stmt->error;
        }
    }
}