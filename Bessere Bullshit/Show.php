<?php


class Show extends Item
{
    private string $roomID;

    private string $movieID;

    private string $time;

    private array $reservations;

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
        return $this->movieID;
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
        return array_merge(parent::toArray(), [
            'roomID' => $this->roomID,
            'movieID' => $this->getMovie(),
            'time' => $this->getTime(),
            'reservations' => $this->getReservations()
        ]);
    }

    public static function createFromConsole(string $filename): Show
    {
        $instance = new static;
        $data = Cinema::createFromFile($filename);

        print $instance->toString($data->getMovies()) . 'MovieID: ';
        $instance->movieID = $data->getMovies()[readline()]->getId();

        print $instance->toString($data->getRooms()) . 'RoomID: ';
        $instance->roomID = $data->getRooms()[readline()]->getId();

        print 'Time: ';
        $instance->time = readline();

        $instance->reservations = [];
        return $instance;

    }

    /**
     * @return array
     */
    public function getReservations(): array
    {
        return $this->reservations;
    }

    public static function createFromArray(array $data): self
    {
        $instance = new static;
        $instance->time = $data['time'];
        $instance->roomID = $data['roomID'];
        $instance->movieID = $data['movieID'];
        $instance->reservations = $data['reservations'];
        return $instance;
    }

    public function addReservation(Reservation $reservation, int $seatNum): void
    {
        $this->reservations[$seatNum] = $reservation->toArray();
        ksort($this->reservations);
    }

    public function getSeatmap($filename): string
    {
        $seatMap = PHP_EOL;
        foreach (Cinema::createFromFile($filename)->getRooms() as $room) {
            if ($room->getId() == $this->roomID) {
                $columns = $room->getCols();
                $rows = $room->getRows();
                break;
            }
        }
        $r = 0;
        $k = 0;
        for ($i = 0; $i < ($columns) * ($rows); $i++) {
            if (array_key_exists($i + 1, $this->reservations)) {
                $seatMap .= 'X ';
            } else {
                $seatMap .= '0 ';
            }
            if (strlen($seatMap) % ((($columns+1) * 2)) == false) {
                $seatMap .= PHP_EOL;
            }
        }


        return $seatMap;
    }


    public function removeReservation(int $id): void
    {
        unset($this->reservations[$id]);
    }
}