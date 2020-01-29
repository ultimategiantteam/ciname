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
        ' Add Presentation'
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

                    $cinema->addPresentation($movieID,$data,$roomname,$time);
                    $cinema->save($filename);
                    break;
            }


        } while ($choice != 0);


    }


}