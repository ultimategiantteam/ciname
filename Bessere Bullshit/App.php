<?php
require_once 'Cinema.php';
require_once 'Room.php';

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
        $cinema->addRoom(Room::createFromConsole());

        foreach ($cinema->getRooms() as $room) {
            printf('%s [%s]' . PHP_EOL, $room->getName(), $room->getId());
        }

        $cinema->getRoom(0)->getName();

        $cinema->persist($filename);
    }
}

$app = new App();
$app->run();