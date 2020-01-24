<?php


class Cinema
{
    private $cinema = [];
    private $filename = '';
    private $timePlan = [];

    public function addRoom(): Room
    {
        $this->cinema += Room::createRoomFromConsole();
    }

    public function setTimePlan(): void
    {
    }

    public function setFilename(string $filename): void
    {
        $this->filename = $filename;
    }

    public function saveData(): void
    {
        file_put_contents($this->filename,json_encode($this->cinema));
    }

    public function loadData(): array
    {
        return json_decode(file_get_contents($this->filename));
    }

    public function createFromArray(): Cinema
    {
        return null;
    }

}