<?php


require_once '../Cinema.php';
require_once '../Persistable.php';
require_once '../Entity.php';
require_once '../Collection.php';
require_once '../Movie.php';
require_once '../Show.php';
require_once '../Room.php';
require_once '../Reservation.php';
require_once '../Reservation.php';

//require_once 'App.php';

$movies = '../save/movies.json';
$shows = '../save/shows.json';
$rooms = '../save/rooms.json';
$reservations = '../save/reservations.json';

use Cinema\Cinema;
use Cinema\Collection;
use Cinema\Movie;
use Cinema\Reservation;
use Cinema\Room;
use Cinema\Show;

Cinema::$movies = Collection::load($movies, Movie::class);
Cinema::$rooms = Collection::load($rooms, Room::class);
Cinema::$shows = Collection::load($shows, Show::class);
Cinema::$reservations = Collection::load($reservations, Reservation::class);