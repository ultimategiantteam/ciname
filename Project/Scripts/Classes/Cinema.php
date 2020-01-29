<?php
require_once "Movie.php";

class Cinema
{
    private $rooms = [];
    private $presentations = ['awwdawda'];
    private $movies = [];
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

    public function addMovie(string $name, int $fsk): void
    {
        $movie = Movie::createMovie($name, $fsk);
        $this->movies[sizeof($this->movies) + 1] = $movie->toArray();
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

}