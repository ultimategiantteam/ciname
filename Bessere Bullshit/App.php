<?php
require_once 'Cinema.php';
require_once 'Room.php';
require_once 'Movie.php';
require_once 'Show.php';
require_once 'Reservation.php';
function lineread($request): string
{
    print $request;
    return readline();

}

class App
{
    private $menu = [
        '##########################',
        'Add room           #',
        'Add Movie          #',
        'Add Show           #',
        'Add Reservation    #',
        'Remove room        #',
        'Remove Movie       #',
        'Remove Show        #',
        'Remove Reservation #'
    ];

    public function run()
    {
        $menustr = 'Menu' . PHP_EOL;
        foreach ($this->menu as $id => $menu) {
            if ($id != 0) {
                $menustr .= "# <" . ($id - 1) . "> ";
            }
            $menustr .= $menu . PHP_EOL;
        }
        $menustr .= $this->menu[0];
        $filename = './cinema.json';
        $cinema = Cinema::createFromFile($filename);
        do {
            print $menustr;
            $choice = readline();
            switch ($choice) {
                case 0: // add a ne Room
                    $cinema->addRoom(Room::createFromConsole());
                    break;
                case 1: // add a new Movie
                    $cinema->addMovie(Movie::createFromConsole());
                    break;
                case 2: // add a new Show
                    $cinema->addShow(Show::createFromConsole($filename));
                    break;
                case 3: // add a new reservation
                    foreach ($cinema->getShows() as $id => $show) {
                        foreach ($cinema->getMovies() as $movie) {
                            if ($movie->getId() == $show->getMovie()) {
                                $movieName = $movie->getName();
                                break;
                            }
                        }
                        printf('<%s> %s %s' . PHP_EOL, $id, $movieName, $show->getTime());
                    }
                    $show = $cinema->getShows()[readline()];
                    print $show->getSeatmap($filename);
                    $show->addReservation(Reservation::createFromConsole(), lineread("\tEnter place"));
                    foreach ($show->getReservations() as $id => $reservation) {
                        printf('<%s> %s %s' . PHP_EOL, $id, $reservation['name'], $reservation['id']);
                    }
                    break;
                case 4:
                    foreach ($cinema->getRooms() as $id => $room) {
                        print "<$id> " . $room->getName();
                    }
                    $cinema->removeRoom(readline());
                    break;
                case 5:
                    foreach ($cinema->getMovies() as $id => $movie) {
                        print "<$id> " . $movie->getName();
                    }
                    $cinema->removeMovie(readline());
                    break;
                case 6:
                    foreach ($cinema->getShows() as $id => $show) {
                        $roomID = $show->getRoom();
                        foreach ($cinema->getRooms() as $room) {
                            if ($roomID = $room->getId()) {
                                $roomName = $room->getName();
                                break;
                            }
                        }
                        print "<$id> " . $roomName . ' ' . $show->getTime() . ' ' . $show->getMovie();
                    }
                    $cinema->removeShow(readline());
                    break;
                case 7:
                    foreach ($cinema->getShows() as $id => $show) {
                        $roomID = $show->getRoom();
                        foreach ($cinema->getRooms() as $room) {
                            if ($roomID = $room->getId()) {
                                $roomName = $room->getName();
                                break;
                            }
                        }
                        print "<$id> " . $roomName . ' ' . $show->getTime() . ' ' . $show->getMovie();
                    }
                    $show = $cinema->getShows()[readline()];
                    print $show->getSeatmap($filename);
                    $show->removeReservation(readline());
                default:
            }
            $cinema->persist($filename);
        } while ($choice != 'x');
    }
}

$app = new App();
$app->run();