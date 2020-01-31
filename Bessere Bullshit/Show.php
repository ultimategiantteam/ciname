<?php


class Show extends Item
{
    private string $roomID;

    private string $movie;

    private string $time;

    /**
     * @return mixed
     */
    public function getRoom()
    {
        return $this->roomID;
    }

    /**
     * @param mixed $room
     * @return Show
     */
    public function setRoom(Room $room)
    {
        $this->roomID = $room;
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
    public function setTime(string $time)
    {
        $this->time = $time;
        return $this;
    }

    public function toArray(): array
    {
        return array_merge(parent::toArray(), ['roomID' => $this->roomID, 'movie' => $this->getMovie(), 'time' => $this->getTime()]);
    }

    public static function createFromConsole(string $filename): Show
    {
        $instance = new static;
        $data = Cinema::createFromFile($filename);

        print $instance->toString($data->getMovies()) . 'MovieID: ';
        $instance->movie = $data->getMovies()[readline()]->getName();

        print $instance->toString($data->getRooms()) . 'RoomID: ';
        $instance->roomID = $data->getRooms()[readline()]->getId();

        print 'Time: ';
        $instance->time = readline();
        return $instance;

    }

    public static function createFromArray(array $data): self
    {
        $instance = new static;
        $instance->time = $data['time'];
        $instance->roomID = $data['roomID'];
        $instance->movie = $data['movie'];
        return $instance;
    }

    public function addReservation(Reservation $reservation): self
    {



    }

}