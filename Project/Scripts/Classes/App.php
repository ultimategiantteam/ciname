<?php
$files = scandir(__DIR__);
foreach ($files as $file) {
    if (preg_match("/.*\.php/", $file)) {
        require_once $file;
    }
}


class App
{
    private $menu = [
        '=====================',
        ' Add Room',
        ' Add Movie',
        ' Add Presentation',
        ' Add Reservation',
        ' Remove Movie',
        ' Remove Room',
        ' Remove Reservation'
    ];


    private function rl($output): string
    {
        print $output;
        return readline();
    }

    public function run(): void
    {
        $filename = 'file.json';
        foreach ($this->menu as $id => $item) {
            if ($id != 0) {
                print "<$id>";
            }
            print $item . PHP_EOL;
        }
        print $this->menu[0] . PHP_EOL;
        if (file_exists($filename)) {
            $cinema = Cinema::createFromFile($filename);
        } else {
            $cinema = Cinema::createNew();
            $cinema->save($filename);
        }
        do {
            $choice = $this->rl('Ihre Wahl: ');
            switch ($choice) {
                case 1:
                    $name = $this->rl('Roomname: ');
                    $columns = $this->rl('Cols: ');
                    $rows = $this->rl('Rows: ');
                    $cinema->addRoom($name, $rows, $columns);
                    $cinema->save($filename);
                    print 'Successfully added!' . PHP_EOL;
                    break;
                case 2:
                    $name = $this->rl('Moviename: ');
                    $fsk = $this->rl('FSK: ');
                    $cinema->addMovie($name, $fsk);
                    $cinema->save($filename);
                    print 'Successfully added!' . PHP_EOL;
                    break;
                case 3:
                    print $cinema->formatMovies();
                    $movieID = $this->rl('MovieID: ');

                    print $cinema->formatRooms();
                    $roomname = $this->rl('Roomname: ');

                    $time = $this->rl('Time: ');

                    $data = $cinema->toArray();

                    $cinema->addPresentation($movieID, $data, $roomname, $time);
                    $cinema->save($filename);
                    break;
                case 4:
                    $name = $this->rl('Vorname+Nachname: ');
                    print $cinema->formatPresentations();
                    $id = $this->rl('Vorstellung: ');
                    $data = $cinema->toArray();
                    $movieName = $data['presentations'][$id]['movie']['name'];
                    $time = $data['presentations'][$id]['time'];
                    $roomName = $data['presentations'][$id]['room']['name'];
                    print $cinema->formatSeatMap($data['presentations'][$id]['room']);
                    $rows = $data['presentations'][$id]['room']['rows'];
                    $seatnumber = $this->rl('Number of Seats: ');
                    $seats = [];
                    for ($i = 0; $i < $seatnumber; $i++) {
                        $numberx = intval($this->rl("Seat numberX $i:"));
                        $numbery = intval($this->rl("Seat numberY $i:"));
                        $seatnum = (($rows * $numbery) + $numberx);
                        $seats[] = $seatnum;
                    }
                    $cinema->addReservation($name, $roomName, $seats, $movieName, $time);
                    $cinema->save($filename);
                    break;
                case 5:
                    print $cinema->formatMovies();
                    $movieID = $this->rl('MovieID: ');
                    $cinema->removeMovie($movieID, $filename);


                    break;
                case 6:
                    print $cinema->formatRooms();
                    $cinema->removeRoom($this->rl('Roomname: '));
                    break;
                case 7:
                    print $cinema->formatPresentations();
                    $pres = $this->rl('PresentationID: ');
                    print $cinema->formatSeatMap($cinema->toArray()['presentations'][$pres]['room']);
                    $numberx = intval($this->rl('Seat NumberX'))-1;
                    $numbery = intval($this->rl('Seat NumberY'));
                    $data = $cinema->toArray();
                    $rows = $data['presentations'][$pres]['room']['rows'];
                    $seatnum = (($rows * $numbery) + $numberx);
                    $cinema->removeReservation($seatnum, $pres, $filename);
                    break;

            }
        } while ($choice != 0);


    }


}