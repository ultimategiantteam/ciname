<?php

require_once "../Classes/Room.php";


$room = new Room();
$room->setRoomSeatMap(4,5);
var_dump($room->toArray());