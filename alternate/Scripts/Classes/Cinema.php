<?php


class Cinema
{
    private $cinema = [
        'rooms' => [],
        'movies' => [],
        'timePlan' => []
    ];

    public function addRoom():void
    {
        $this->cinema['rooms'][] = Room::createRoomFromConsole();
    }

    public function setTimePlan(): void
    {

    }

    public function saveData(string $filename): void
    {
        file_put_contents($filename,json_encode($this->cinema));
    }

    public function loadData(string $filename): array
    {
        return json_decode(file_get_contents($filename));
    }

    public static function createFromArray(array $data): Cinema
    {
        $cinema = new Cinema();
        foreach ($data['room'] as $room) {

        }
        return $cinema;
    }

}