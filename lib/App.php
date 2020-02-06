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

/**
 * Class App
 * @package Cinema
 */
class App
{
    public function run()
    {

        $movies = __DIR__ . '/save/movies.json';
        $shows = __DIR__ . '/save/shows.json';
        $rooms = __DIR__ . '/save/rooms.json';
        $reservations = __DIR__ . '/save/reservations.json';
        $scores = '==============================';

        $menuPoints = [
            $scores,
            '(1) movie',
            '(2) room',
            '(3) show',
            '(4) reservation',
            '(x) Exit',
            $scores,
        ];
        $inObjectPoints = [
            $scores,
            '(1) Show',
            '(2) Add',
            '(3) Edit',
            '(x) Exit',
            $scores
        ];

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

        function printTitle(string $title, string $scores): void
        {
            print PHP_EOL . $title . PHP_EOL . $scores . PHP_EOL;
        }

        function printObjectPoints(string $title, array $inObjectPoints): void
        {
            foreach ($inObjectPoints as $id => $points) {
                if ($id != 0 && $id != 5) {
                    print $points . " $title" . PHP_EOL;
                } else {
                    print $points . PHP_EOL;
                }
            }
        }

        function inObjectPoints()
        {
            return readlineWithPattern("choose", "[1-3x]{1}", "Invalid answer");
        }

        Cinema::$movies = Collection::load($movies, Movie::class);
        Cinema::$rooms = Collection::load($rooms, Room::class);
        Cinema::$shows = Collection::load($shows, Show::class);
        Cinema::$reservations = Collection::load($reservations, Reservation::class);
        $imgString = '';
        $images = scandir('./save/Movies');
        foreach ($images as $id => $image) {
            if ($id > 1) {
                $imgString .= $image . PHP_EOL;
            }
        }
        print $imgString;

        do {
            foreach ($menuPoints as $points) {
                print $points . PHP_EOL;
            }

            $MainInput = readlineWithPattern("choose", "[1-4x]{1}", "Invalid answer");

            switch ($MainInput) {
                case 1:
                    do {
                        printObjectPoints("movie", $inObjectPoints);
                        $input = inObjectPoints();

                        switch ($input) {
                            case 1:
                                printTitle("Show movies", $scores);
                                foreach (Cinema::$movies as $id => $movie) {
                                    printf("%d\t%s\n\tDuration: %s\n\n",
                                        $id,
                                        $movie->getName(),
                                        $movie->getDuration());
                                }
                                break;
                            case 2:
                                printTitle("Add movies", $scores);
                                Cinema::$movies->append($movIe = Movie::createFromConsole(
                                    readlineWithPattern("Name", "([a-z ]*)(3d)?", "Maximum lenght = 29"),
                                    readlineWithPattern("Duration", "[0-9].[0-5][0-9]", "Format: (00.00)"),
                                    readlineWithPattern("Fsk", "[0-1][0-9]", "Fromat: (0-19)")));
                                Cinema::$movies->persist($movies);
                                print $imgString;
                                $path = __DIR__ . '/save/Movies/' . readline();
                                rename($path, __DIR__ . '/save/Saved Movies/' . $movIe->getId() . '.jpg');
                                break;
                            case 3:
                                printTitle("Edit movies", $scores);
                                break;
                            default:
                        }
                    } while ($input != "x");
                    break;
                case 2:
                    do {
                        printObjectPoints("room", $inObjectPoints);
                        $input = inObjectPoints();

                        switch ($input) {
                            case 1:
                                printTitle("Show rooms", $scores);
                                foreach (Cinema::$rooms as $id => $room) {
                                    printf("%d\t%s\n\t Seats: %d\n\n",
                                        $id,
                                        $room->getName(),
                                        $room->getColumns() * $room->getRows());
                                }
                                break;
                            case 2:
                                print " Add room" . PHP_EOL . $scores . PHP_EOL;
                                Cinema::$rooms->append(Room::createFromConsole(
                                    readlineWithPattern("Room", "[a-z]*", "Format: as many letters as you want"),
                                    readlineWithPattern("Columns", "[0-9]{1,2}", "Maximum = 99"),
                                    readlineWithPattern("Rows", "[0-9]{1,2}", "Maximum = 99")));
                                Cinema::$rooms->persist($rooms);
                                break;
                            case 3:
                                printTitle("Edit rooms", $scores);
                                break;
                            default:
                        }
                    } while ($input != "x");
                    break;
                case 3:
                    do {
                        printObjectPoints("show", $inObjectPoints);
                        $input = inObjectPoints();

                        switch ($input) {
                            case 1:
                                printTitle("Show shows", $scores);
                                foreach (Cinema::$shows as $id => $show) {
                                    printf("%d\tRoom: %s\n\tMovie: %s\n\tTime: %s hours\n\tFree seats: %d\n\n",
                                        $id,
                                        $show->getRoom()->getName(),
                                        $show->getMovie()->getName(),
                                        $show->getTime(),
                                        $show->getFreeSeats());
                                }
                                break;
                            case 2:
                                print "Add show" . PHP_EOL . $scores . PHP_EOL;
                                Cinema::$shows->append(Show::createFromConsole(
                                    readlineWithPattern("Which time", "[0-9]:[0-5][0-9]", "Format: (00:00)")));
                                Cinema::$shows->persist($shows);
                                break;
                            case 3:
                                printTitle("Edit shows", $scores);
                                break;
                            default:
                        }
                    } while ($input != "x");
                    break;
                case 4:
                    do {
                        printObjectPoints("reservation", $inObjectPoints);
                        $input = inObjectPoints();

                        switch ($input) {
                            case 1:
                                printTitle("Show reservation", $scores);
                                foreach (Cinema::$reservations as $id => $reservation) {
                                    printf("%d\tName: %s\n\tRoom: %s\n\tMovie: %s\n\tTime: %s\n\n",
                                        $id,
                                        $reservation->getName(),
                                        $reservation->getShow()->getRoom()->getName(),
                                        $reservation->getShow()->getMovie()->getName(),
                                        $reservation->getShow()->getTime());
                                }
                                break;
                            case 2:
                                printTitle("Add reservation", $scores);
                                Cinema::$reservations->append(Reservation::createFromConsole(
                                    readlineWithPattern("Name", "[a-z ]*", "Maximum lenght = 29")));
                                Cinema::$reservations->persist($reservations);
                                break;
                            case 3:
                                printTitle("Edit reservation", $scores);
                                break;
                            default:
                        }
                    } while ($input != "x");
                    break;
                default:
            }
        } while ($MainInput != 'x');
        die("Program is dead");

    }
}

$app = new App;
$app->run();