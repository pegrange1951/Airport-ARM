<?php

class PassengersView {
    public function render() {
        echo '
    <h1>Регистрация пассажира на рейс</h1>
    <form action="addpassenger" method="post">
        <label for="full_name">ФИО:</label><br>
        <input type="text" id="full_name" name="full_name"><br>
        
        <label for="passport_number">Номер паспорта:</label><br>
        <input type="text" id="passport_number" name="passport_number"><br>
        
        <label for="flight_number">Номер рейса:</label><br>
        <input type="text" id="flight_number" name="flight_number"><br>
        
        <label for="seat_number">Номер места:</label><br>
        <input type="text" id="seat_number" name="seat_number"><br>
        
        <input type="submit" value="Зарегистрировать пассажира">
    </form>';
    }
}