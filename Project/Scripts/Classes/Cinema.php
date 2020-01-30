<?php
require_once "Movie.php";

class Cinema
{
    private array $rooms = [];
    private array $presentations = ['awwdawda'];
    private array $movies = [];
    const props = ['rooms', 'presentations', 'movies'];

    /**
     * @param string $filename
     */
    public function save(string $filename): void
    {
        $i = 0;
        $rawData = [];
        foreach ($this as $property) {
            $rawData[self::props[$i]] =
                $property;
            $i++;
        }

        file_put_contents($filename, json_encode($rawData));
    }

    /**
     * @param string $filename
     * @return Cinema
     */
    public static function createFromFile(string $filename): Cinema
    {
        $json = file_get_contents($filename);
        $data = json_decode($json, JSON_OBJECT_AS_ARRAY);
        $cinema = new Cinema();
        $cinema->rooms = $data['rooms'];
        $cinema->presentations = $data['presentations'];
        $cinema->movies = $data['movies'];
        return $cinema;
    }

    public function addRoom(string $name, int $rows, int $columns): void
    {
        $room = new Room();
        $room->createSeatMap($rows, $columns);
        $room->setName($name);
        $this->rooms[$name] = $room->toArray();
    }

    public function removeRoom(string $name): void
    {
        unset($this->rooms[$name]);
    }

    /**
     * @param string $name
     * @param int $fsk
     */
    public function addMovie(string $name, int $fsk): void
    {
        $movie = Movie::createMovie($name, $fsk);
        $this->movies[sizeof($this->movies) + 1] = $movie->toArray();
    }

    public function removeMovie(int $id, string $filename): void
    {
        unset($this->movies[$id + 1]);
        $this->save($filename);


    }

    public function toArray(): array
    {
        $i = 0;
        $rawData = [];
        foreach ($this as $property) {
            $rawData[self::props[$i]] =
                $property;
            $i++;
        }
        return $rawData;
    }

    /**
     * @param int $id
     * @param array $data
     * @param string $roomname
     * @param string $time
     */
    public function addPresentation(int $id, array $data, string $roomname, string $time): void
    {
        $pre = new Presentation();
        $pre->setAttributes($id, $data, $roomname, $time);
        $this->presentations[] = $pre->toArray();
    }

    public static function createNew(): Cinema
    {
        $cinema = new Cinema();
        $cinema->rooms = [];
        $cinema->presentations = [];
        $cinema->movies = [];
        return $cinema;
    }

    public function formatRooms()
    {
        $string = '';
        $data = $this->toArray();
        foreach ($data['rooms'] as $room) {
            $string .= 'Name: ' . $room['name'] . PHP_EOL;
        }
        return $string;
    }

    public function formatPresentations()
    {
        $string = '';
        $id = 0;
        $data = $this->toArray();
        foreach ($data['presentations'] as $presentation) {
            $string .= $id;
            $string .= "  Movie: " . $presentation['movie']['name'] . PHP_EOL;
            $string .= "\tRoom: " . $presentation['room']['name'] . PHP_EOL;
            $string .= "\tTime: " . $presentation['time'] . PHP_EOL;
            $id++;
        }

        return $string;
    }

    public function formatMovies()
    {
        $string = '';
        $id = 1;
        $data = $this->toArray();
        foreach ($data['movies'] as $movie) {
            $string .= $id;
            $string .= "  Name: " . $movie['name'] . PHP_EOL . "\tFSK: " . $movie['fsk'] . PHP_EOL;
            $id++;
        }
        return $string;
    }

    /**
     * @param string $name
     * @param string $roomName
     * @param array $seats
     * @param string $moviename
     * @param string $time
     */
    public function addReservation(string $name, string $roomName, array $seats, string $moviename, string $time): void
    {
        $reservation = Reservation::createReservation($name, $seats, $moviename, $time, $roomName);
        $reserv = $reservation->toArray();
        foreach ($this->presentations as $id => $presentation) {
            if ($presentation['movie']['name'] == $moviename) {
                if ($presentation['time'] == $time) {
                    foreach ($seats as $seat) {
                        $this->presentations[$id]['room']['seats'][$seat - 1]['reserved'] = true;
                        $this->presentations[$id]['room']['seats'][$seat - 1]['reservation'] = ['customer' => $name];
                    }
                } else {
                    continue;
                }
            } else {
                continue;
            }
        }


    }

    public function formatSeatMap(array $room)
    {


        $seatmap = $room['seats'];
        foreach ($seatmap as $id => $seat) {
            if ($seat['reserved'] == true) {
                $icon = 'X';
            } else {
                $icon = 'O';
            }
            $newSeatMap[$id] = $icon;
        }

        $string = '  ';
        for ($s = 1; $s <= $room['cols']; $s++) {
            $string .= $s . ' ';
        }
        $string .= PHP_EOL;
        $string .= 0 . ' ';
        $id = 0;
        for ($j = 1; $j <= $room['rows']; $j++) {

            for ($i = 1; $i <= $room['cols']; $i++) {
                $string .= $newSeatMap[$id] . ' ';
                $id++;
            }
            $string .= PHP_EOL;
            $string .= $j . ' ';
        }

        return $string;
    }

    public function removeReservation($seatnumber, $id, $filename): void
    {
        $newReservation = new Seat();
        $newReservation = $newReservation->toArray($seatnumber);
        $this->presentations[$id]['room']['seats'][$seatnumber] = $newReservation;
        $this->save($filename);
    }


}