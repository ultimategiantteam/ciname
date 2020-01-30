<?php

require_once "Seat.php";

class Room
{
    private string $name = '';
    private int $cols;
    private int $rows;
    private array $seats = [];

    public function createSeatMap(int $rows, int $cols): void
    {
        $this->rows = $rows;
        $this->cols = $cols;
        $iterate = 0;
        for ($x = 0; $x < $rows; $x++) {
            for ($y = 0; $y < $cols; $y++) {
                $iterate++;
                $seat = new Seat();
                $this->seats[] = $seat->toArray($iterate);
            }
        }
    }

    public function getSeats(): array
    {
        return $this->seats;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'seats' => $this->seats,
            'rows' => $this->rows,
            'cols' => $this->cols
        ];
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public static function createFromArray(array $data, $id): Room
    {
        $roomArray = $data['rooms'][$id];
        $room = new Room();
        $room->setName($id);
        $room->setName($id);
        $room->setName($id);
        $room->createSeatMap($roomArray['rows'],$roomArray['cols']);

        return $room;
    }


}