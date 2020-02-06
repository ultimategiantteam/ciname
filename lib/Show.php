<?php

namespace Cinema;

class Show extends Entity
{
    private $movie;
    private $room;
    private string $time;

    public static function createFromArray(array $data)
    {
        $instance = parent::createFromArray($data);
        $instance->movie = Cinema::$movies->find($data['movie']);
        $instance->room = Cinema::$rooms->find($data['room']);
        $instance->time = $data['time'];
        return $instance;
    }

    public static function createFromConsole(string $time)
    {
        //scores
        $scores = "==============================" .PHP_EOL;

        $instance = new static;
        //Which Time
        $instance->time = $time;
        //Ausgabe aller Movies
        foreach (Cinema::$movies as $i => $movie) {
            printf('%d %s' . PHP_EOL, $i, $movie->getName());
        }
        print $scores;

        do {
            print "Movie #:";
            $input = readline();
        } while (array_key_exists($input, Cinema::$movies) == false);
        $instance->movie = Cinema::$movies->offsetGet($input);;

        //Ausgabe aller Rooms
        foreach (Cinema::$rooms as $i => $room) {
            printf('%d %s' . PHP_EOL, $i, $room->getName());
        }
        print $scores;

        do {
            print "Room #:";
            $input = readline();
        } while (array_key_exists($input, Cinema::$rooms) == false);
        $instance->room = Cinema::$rooms->offsetGet($input);

        return $instance;
    }

    public function toArray(): array
    {
        return parent::toArray() + ['movie' => $this->movie->getId(), 'room' => $this->room->getId(), 'time' => $this->getTime()];
    }

    /**
     * @return mixed
     */
    public function getMovie(): Movie
    {
        return $this->movie;
    }

    public function getRoom(): Room
    {
        return $this->room;
    }

    public function getReservation(): array
    {
        $reservations = [];
        foreach (Cinema::$reservations as $reservation) {
            if ($reservation->getShow()->getId() == $this->getId()) $reservations[] = $reservation;
        }
        return $reservations;
    }

    public function isSeatFree(string $seats): bool
    {
        $reservations = $this->getReservation();
        if ($reservations == null) return true;

        foreach ($reservations as $reservation) {
            //Hat alle besetzten Stühle dieser Show in einem Array
            $reservated = $reservation->getSeats();
            foreach ($reservated as $seat) {
                if ($seat == intval($seats)) return false;
            }
        }
        return true;
    }
    public function getRows():int
    {
        return $this->getRoom()->getRows();
    }
    public function getColumns():int
    {
        return $this->getRoom()->getColumns();
    }

    public function printFreeSeats(): void
    {
        $rows = $this->getRows();
        $columns = $this->getColumns();

        for ($i = 0; $i < $rows; $i++) {
            for ($j = 0; $j < $columns; $j++) {
                $seat = $i * $columns + $j;
                if ($this->isSeatFree($seat) == true) print "O"; else print "X";
            }
            print PHP_EOL;
        }
    }

    public function getFreeSeats():int
    {
        $rows = $this->getRows();
        $columns = $this->getColumns();

        $seats = 0;
        for ($i = 0; $i < $rows; $i++) {
            for ($j = 0; $j < $columns; $j++) {
                $seat = $i * $columns + $j;
                if ($this->isSeatFree($seat) == true) $seats++;
            }
        }
        return $seats;
    }

    /**
     * @return string
     */
    public function getTime(): string
    {
        return $this->time;
    }

    /**
     * @param mixed $movie
     */
    public function setMovie($movie): void
    {
        $this->movie = $movie;
    }

    /**
     * @param mixed $room
     */
    public function setRoom($room): void
    {
        $this->room = $room;
    }

    /**
     * @param string $time
     */
    public function setTime(string $time): void
    {
        $this->time = $time;
    }

}