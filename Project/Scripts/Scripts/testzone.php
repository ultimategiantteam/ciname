<?php
require_once "../Classes/Room.php";
require_once "../Classes/Cinema.php";
require_once "../Classes/Presentation.php";

$cinema = new Cinema();
$cinema = Cinema::createFromFile('file.json');
$cinema->addPresentation(1,$cinema->toArray(),'Genkidama','123123123');
$cinema->save('file.json');

