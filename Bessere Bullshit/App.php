<?php
require_once 'Cinema.php';
require_once 'Room.php';
require_once 'Movie.php';
require_once 'Show.php';
function getInput($request): string
{
    print $request;
    return readline();
}


class App
{
    public function run()
    {
        $filename = './cinema.json';

        $cinema = Cinema::createFromFile($filename);
        $cinema->addRoom(Room::createFromConsole());
        $cinema->addMovie(Movie::createFromConsole());
        $cinema->persist($filename);
        $cinema->addShow(Show::createFromConsole($filename));
        foreach ($cinema->getRooms() as $room) {
            printf('%s [%s]' . PHP_EOL, $room->getName(), $room->getId());
        }
        foreach ($cinema->getShows() as $show) {
            printf('%s %s %s [%s]' . PHP_EOL, $show->getMovie(), $show->getRoom(), $show->getTime(), $show->getId());
        }
        $cinema->getRoom(0)->getName();
        $cinema->persist($filename);
    }
}

$app = new App();
$app->run();