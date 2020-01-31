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

print readline('hello');


class App
{
    private $menu = [
        '########################',
        'Add room         #',
        'Add Movie        #',
        'Add Show         #',
        'Add Reservation  #',
    ];
    public function run()
    {
        $menustr = 'Menu' . PHP_EOL;
        foreach ($this->menu as $id => $menu) {
            if($id != 0){
                $menustr .= "# <" . ($id-1) . "> ";
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
                case 0:
                    $cinema->addRoom(Room::createFromConsole());
                    break;
                case 1:
                    $cinema->addMovie(Movie::createFromConsole());
                    break;
                case 2:
                    $cinema->addShow(Show::createFromConsole($filename));
                    break;
                case 3:
                    foreach ($cinema->getShows() as $id => $show) {
                        printf('<%s> %s %s' . PHP_EOL, $id, $show->getMovie(), $show->getTime());
                    }
                    $show = $cinema->getShows()[readline()];
                    $show->addReservation(Reservation::createFromConsole(),lineread("\tEnter place"));

                    foreach ($show->getReservations() as $id => $reservation) {
                        printf('<%s> %s %s' . PHP_EOL, $id, $reservation['name'], $reservation['id']);
                    }

                    break;
            }
            $cinema->persist($filename);
        } while ($choice != 'x');
    }
}

$app = new App();
$app->run();