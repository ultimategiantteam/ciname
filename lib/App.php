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
class App extends Cinema
{
    public static $movies;
    public static $shows;
    public static $rooms;
    public static $reservations;


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
            '(7) Show rooms',
            '(8) Show shows',
            '(9) Show reservations',
            '(x) Exit',
            $scores,
        ];

        static::$movies = Collection::load($movies, Movie::class);
        static::$rooms = Collection::load($rooms, Room::class);
        static::$shows = Collection::load($shows, Show::class);
        static::$reservations = Collection::load($reservations, Reservation::class);

        do {
            foreach ($menuPoints as $points) {
                print $points . PHP_EOL;
            }

            $input = readlineWithPattern("choose", "[1-9x]{1}", "Invalid answer");

            switch ($input) {
                case 1:
                    print "create movie" . PHP_EOL . $scores . PHP_EOL;
                    static::$movies->append(Movie::createFromConsole(
                        readlineWithPattern("Name", "([a-z ]*)(3d)?", "Maximum lenght = 29"),
                        readlineWithPattern("Time", "[0-9]:[0-5][0-9]", "Format: (00:00)"),
                        readlineWithPattern("Fsk", "[0-1][0-9]", "Fromat: (0-19)")));
                    static::$movies->persist($this->moviesFile);
                    break;
                case 2:
                    print "create room" . PHP_EOL . $scores . PHP_EOL;
                    static::$rooms->append(Room::createFromConsole(
                        readlineWithPattern("Room", "[a-z]*", "Format: as many letters as you want"),
                        readlineWithPattern("Columns", "[0-9]{1,2}", "Maximum = 99"),
                        readlineWithPattern("Rows", "[0-9]{1,2}", "Maximum = 99")));
                    static::$rooms->persist($this->roomsFile);
                    break;
                case 3:
                    print "Create show" . PHP_EOL . $scores . PHP_EOL;
                    static::$shows->append(Show::createFromConsole(
                        readlineWithPattern("Which time","[0-9]:[0-5][0-9]", "Format: (00:00)")));
                    static::$shows->persist($this->showsFile);
                    break;
                case 4:
                    print "Create reservation" . PHP_EOL . $scores . PHP_EOL;
                    static::$reservations->append(Reservation::createFromConsole(
                        readlineWithPattern("Name", "[a-z ]*", "Maximum lenght = 29")));
                    static::$reservations->persist($this->reservationsFile);
                    break;
                case 5:
                    break;
                case 6:
                    break;
                case 7:
                    break;
                case 8:
                    break;
                case 9:
                    break;
            }
        } while ($input != 'x');
        die("Program is dead");

        /*  //Show all movies
          foreach (static::$movies as $movie) {
             printf('%s [%s]' . PHP_EOL, $movie->getName(), $movie->getId());
          }
          //Show all rooms
          foreach (static::$rooms as $room) {
              printf('%s [%s]' . PHP_EOL, $room->getName(), $room->getId());
          }*/

    }
}

$app = new App;
$app->run();