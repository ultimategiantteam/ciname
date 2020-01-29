<?php
require_once "../Classes/Room.php";
$test = new Room();
$test->createSeatMap(trim(readline()),trim(readline()));

var_dump($test->getSeats());