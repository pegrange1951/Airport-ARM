<?php

class PassengersModel {
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function InsertPassenger($full_name, $passport_number, $flight_number, $seat_number) {
        $sql = "INSERT INTO passengers (full_name, passport_number, flight_number, seat_number) VALUES (?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($sql);

        if(!$stmt){
            die("Ошибка подготовки запроса" . $this->conn->error);
        }

        $stmt->bind_param("ssss", $full_name, $passport_number, $flight_number, $seat_number);

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