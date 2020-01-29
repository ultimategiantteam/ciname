<?php
require_once "../Classes/App.php";

$cinema = Cinema::createFromFile('file.json');
$cinema->addReservation('Peter Ueli Stein','Nino',[1],'Phil','16:30');
$cinema->save('file.json');





/*
$app = new App();
$app->run();
*/