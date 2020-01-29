<?php
require_once "../Classes/Room.php";
require_once "../Classes/Cinema.php";
require_once "../Classes/Presentation.php";

$cinema = new Cinema();
$cinema = Cinema::createFromFile('file.json');
$pre = new Presentation();
$pre->setMovie(1,$cinema->toArray(),'Genkidama','13.12.0911 13:12');

