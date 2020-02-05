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
        $instance->movie = App::$movies->find($data['movie']);
        $instance->room = App::$rooms->find($data['room']);
        $instance->time = $data['time'];
        return $instance;
    }

    public static function createFromConsole(string $time)
    {
        $instance = new static;
        //Which Time
        $instance->time = $time;
        //Ausgabe aller Movies
        foreach (App::$movies as $i => $movie) {
            printf('%d %s' . PHP_EOL, $i, $movie->getName());
        }
        print "==============================" . PHP_EOL;

        do {
            print "Movie #:";
            $input = readline();
        } while (array_key_exists($input, App::$movies) == false);
        $instance->movie = App::$movies->offsetGet($input);;

        //Ausgabe aller Rooms
        foreach (App::$rooms as $i => $room) {
            printf('%d %s' . PHP_EOL, $i, $room->getName());
        }
        print "==============================" . PHP_EOL;

        do {
            print "Room #:";
            $input = readline();
        } while (array_key_exists($input, App::$rooms) == false);
        $instance->room = App::$rooms->offsetGet($input);

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
        foreach (App::$reservations as $reservation) {
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
                if($seat == intval($seats))return false;
            }
        }
        return true;
    }

    /**
     * @return string
     */
    public function getTime(): string
    {
        return $this->time;
    }
}