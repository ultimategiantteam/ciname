<?php

namespace Cinema;

require_once 'Persistable.php';
require_once 'Entity.php';
require_once 'Collection.php';
require_once 'Movie.php';
require_once 'Show.php';
require_once 'Room.php';
require_once 'Reservation.php';
require_once 'Cinema.php';

function readlineWithPattern(string $question, string $pattern, string $ansIfFalse)
{
    $matches = false;
    while ($matches == false) {
        print $question . ": ";
        $input = readline();
        if (!preg_match("/$pattern/i", "$input")) print $ansIfFalse . PHP_EOL; else $matches = true;
    }
    return $input;
}

/**
 * Class App
 * @package Cinema
 */
class App
{

    public function run()
    {

        $movies = __DIR__ . '/movies.json';
        $shows = __DIR__ . '/shows.json';
        $rooms = __DIR__ . '/rooms.json';
        $reservations = __DIR__ . '/reservations.json';
        $scores = '==============================';

        $menuPoints = [
            $scores,
            '(1) Add movie',
            '(2) Add room',
            '(3) Add presentation',
            '(4) Add reservation',
            '(5) Show movies',
            '(6) Show rooms',
            '(7) Show shows',
            '(8) Show reservations',
            '(x) Exit',
            $scores,
        ];

        Cinema::$movies = Collection::load($movies, Movie::class);
        Cinema::$rooms = Collection::load($rooms, Room::class);
        Cinema::$shows = Collection::load($shows, Show::class);
        Cinema::$reservations = Collection::load($reservations, Reservation::class);

        do {
            foreach ($menuPoints as $points) {
                print $points . PHP_EOL;
            }

            $input = readlineWithPattern("choose", "[1-8x]{1}", "Invalid answer");

            switch ($input) {
                case 1:
                    print "create movie" . PHP_EOL . $scores . PHP_EOL;
                    Cinema::$movies->append(Movie::createFromConsole(
                        readlineWithPattern("Name", "([a-z ]*)(3d)?", "Maximum lenght = 29"),
                        readlineWithPattern("Time", "[0-9]:[0-5][0-9]", "Format: (00:00)"),
                        readlineWithPattern("Fsk", "[0-1][0-9]", "Fromat: (0-19)")));
                    Cinema::$movies->persist($movies);
                    break;
                case 2:
                    print "create room" . PHP_EOL . $scores . PHP_EOL;
                    Cinema::$rooms->append(Room::createFromConsole(
                        readlineWithPattern("Room", "[a-z]*", "Format: as many letters as you want"),
                        readlineWithPattern("Columns", "[0-9]{1,2}", "Maximum = 99"),
                        readlineWithPattern("Rows", "[0-9]{1,2}", "Maximum = 99")));
                    Cinema::$rooms->persist($rooms);
                    break;
                case 3:
                    print "Create show" . PHP_EOL . $scores . PHP_EOL;
                    Cinema::$shows->append(Show::createFromConsole(
                        readlineWithPattern("Which time", "[0-9]:[0-5][0-9]", "Format: (00:00)")));
                    Cinema::$shows->persist($shows);
                    break;
                case 4:
                    print "Create reservation" . PHP_EOL . $scores . PHP_EOL;
                    Cinema::$reservations->append(Reservation::createFromConsole(
                        readlineWithPattern("Name", "[a-z ]*", "Maximum lenght = 29")));
                    Cinema::$reservations->persist($reservations);
                    break;
                case 5:
                    print "Show movies" . PHP_EOL . $scores . PHP_EOL;
                    foreach (Cinema::$movies as $movie) {
                        print $movie->getName() . PHP_EOL;
                    }
                    break;
                case 6:
                    print "Show rooms" . PHP_EOL . $scores . PHP_EOL;
                    foreach (Cinema::$rooms as $room) {
                        print $room->getName() . PHP_EOL;
                    }
                    break;
                case 7:
                    print "Show shows" . PHP_EOL . $scores . PHP_EOL;
                    foreach (Cinema::$shows as $id => $show) {
                        printf("%d\tRoom: %s\n\tMovie: %s\n\tTime: %s hours\n\tFree seats: %d\n\n",$id,$show->getRoom()->getName(),$show->getMovie()->getName(),$show->getTime(),$show->getFreeSeats());
                    }
                    break;
                case 8:
                    print "Show reservations" . PHP_EOL . $scores . PHP_EOL;
                    foreach (Cinema::$reservations as $reservation) {
                        print $reservation->getName() . PHP_EOL;
                    }
                    break;
            }
        } while ($input != 'x');
        die("Program is dead");

        /*  //Show all movies
          foreach (Cinema::$movies as $movie) {
             printf('%s [%s]' . PHP_EOL, $movie->getName(), $movie->getId());
          }
          //Show all rooms
          foreach (Cinema::$rooms as $room) {
              printf('%s [%s]' . PHP_EOL, $room->getName(), $room->getId());
          }*/

    }
}

$app = new App;
$app->run();