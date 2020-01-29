<?php
require_once "../Classes/Room.php";
require_once "../Classes/Cinema.php";


$ciname = new Cinema();
$ciname->addRoom('Genkidama',2,3);
$ciname->save('file.json');
