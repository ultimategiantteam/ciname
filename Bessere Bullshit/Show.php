<?php


class Show extends Item
{
    private $room;

    private $movie;

    private string $time;

    /**
     * @return mixed
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * @param mixed $room
     * @return Show
     */
    public function setRoom(Room $room)
    {
        $this->room = $room;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMovie()
    {
        return $this->movie;
    }


    /**
     * @param mixed $movie
     * @return Show
     */
    public function setMovie(Movie $movie)
    {
        $this->movie = $movie;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTime(): string
    {
        return $this->time;
    }

    /**
     * @param mixed $time
     * @return Show
     */
    public function setTime($time)
    {
        $this->time = $time;
        return $this;
    }

    public function toArray(): array
    {
        return array_merge(parent::toArray(), ['room' => $this->getRoom(), 'movie' => $this->getMovie(), 'time' => $this->getTime()]);
    }

    public static function createFromConsole(string $filename): Show
    {
        $instance = new static;
        $data = Cinema::createFromFile($filename);

        print $instance->toString($data->getMovies()) . 'MovieID: ';
        $instance->movie = $data->getMovies()[readline()]->getName();

        print $instance->toString($data->getRooms()) . 'RoomID: ';
        $instance->room = $data->getRooms()[readline()]->getName();

        print 'Time: ';
        $instance->time = readline();
        return $instance;

    }

    public static function createFromArray(array $data):self
    {
        $instance = new static;
        $instance->time = $data['time'];
        $instance->room = $data['room'];
        $instance->movie = $data['movie'];
        return $instance;
    }
}