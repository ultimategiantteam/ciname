<?php


class Reservation
{
    private string $name = '';
    private string $movie = '';
    private string $time = '';
    private string $roomName = '';
    private array $seats = [];

    /*
        public function setAttributes(array $data, string $roomName, array $seats, string $name):void
        {
            $data = $data['presentations'];
            $this->name = $name;
            $this->roomName = $data['room']['name'];
            $this->movie = $data['movie']['name'];
            $this->time = $data['time'];
            foreach ($seats as $seat){
                $this->seats[] = $seat;
            }
        }

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

    public function toArray()
    {
        return [
            'name' => $this->name,
            'time' => $this->time,
            'movie' => $this->movie
        ];



    }


}