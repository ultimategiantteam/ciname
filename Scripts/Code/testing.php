<?php

require_once "../Classes/Room.php";


$room = Room::createRoomFromConsole('Hugo',5,7);
$room->addMovie('STAR WARS','16:30');
print $room->toString();