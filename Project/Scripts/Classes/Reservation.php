<?php


class Reservation
{
    private string $name = '';
    private string $movie = '';
    private string $time = '';
    private string $roomName = '';
    private array $seats = [];


    /**
     * @param string $name
     * @param array $seats
     * @param string $movie
     * @param string $time
     * @param string $roomName
     * @return Reservation
     */
    public static function createReservation(string $name, array $seats, string $movie, string $time, string $roomName): Reservation
    {
        $reserv = new Reservation();
        $reserv->name = $name;
        $reserv->seats = $seats;
        $reserv->movie = $movie;
        $reserv->time = $time;
        $reserv->roomName = $roomName;
        return $reserv;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'name' => $this->name,
            'time' => $this->time,
            'movie' => $this->movie
        ];



    }


}