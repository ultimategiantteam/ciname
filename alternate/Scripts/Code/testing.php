<?php

require_once "../Classes/Room.php";


$room = Room::createRoomFromConsole('Hugo',9,9);
$room->addMovie('STAR WARS','16:30');
print $room->toString();
print $room->getSeatMapAsString();
$room->addReservation(3,2);
print $room->getSeatMapAsString();