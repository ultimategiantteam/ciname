<?php
require_once "../Classes/Cinema.php";
$test = new Cinema();
$test->save('file.json');
$test->load('file.json');