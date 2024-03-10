<?php

class FlightsView {
    public function render() {
        echo '
    <h1>Добавление нового рейса</h1>
    <form action="addflight" method="post">
        <label for="flight_number">Номер рейса:</label><br>
        <input type="text" id="flight_number" name="flight_number"><br>
        
        <label for="departure">Пункт отправления:</label><br>
        <input type="text" id="departure" name="departure"><br>
        
        <label for="destination">Пункт назначения:</label><br>
        <input type="text" id="destination" name="destination"><br>
        
        <label for="departure_time">Время вылета:</label><br>
        <input type="datetime-local" id="departure_time" name="departure_time"><br>
        
        <label for="arrival_time">Время прибытия:</label><br>
        <input type="datetime-local" id="arrival_time" name="arrival_time"><br>
        
        <input type="submit" value="Добавить рейс">
    </form>';
    }
}