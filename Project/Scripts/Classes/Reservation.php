<?php


class Reservation
{
    private string $name = '';
    private string $movie = '';
    private string $time = '';
    private string $roomName = '';
    private array $seats = [];

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    private function setAttributes(array $data, string $roomName, int $id, array $seats):void
    {
        $data = Presentation::createFromArray($data['presentations']);
        $this->roomName = $data['room']['name'];
        $this->movie = $data['movie']['name'];
        $this->time = $data['time'];
        $seats =
    }

}