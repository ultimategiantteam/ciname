<?php
require_once 'Cinema.php';

class Room extends Cinema
{
    private $rows = 7;
    private $columns = 8;
    private $RoomName = '';
    private $roomSeatMap = [];
    private $displayTimes = [];

    /**
     * @param string $RoomName
     */
    public function setRoomName(string $RoomName): void
    {
        $this->RoomName = $RoomName;
    }

    /**
     * @param int $rows
     * @param int $columns
     */
    public function setRoomSeatMap(int $rows, int $columns): void
    {
        $this->columns = $columns;
        $this->rows = $rows;
        for ($x = 0; $x < $rows; $x++) {
            for ($y = 0; $y < $columns; $y++) {
                $this->roomSeatMap[$x] .= 'O';
            }
        }
    }

    /**
     * @return string
     */
    public function getSeatMapAsString():string
    {
        $seatMap = ' ';
        $alphas = range('A','Z');
        for($i = 0; $i < $this->columns; $i++){
            $seatMap .= ' ' . $i;
        }
        $seatMap .= PHP_EOL;
        foreach ($this->roomSeatMap as $id => $value){
            $seatMap .= $alphas[$id] . ' ';
            for ($i = 0; $i < $this->columns; $i++){
                $seatMap .= $value[$i] . ' ';
            }
            $seatMap .= PHP_EOL;
        }
        return $seatMap;
    }

    public function getFreeSeats(array $room): int
    {

    }

    public function addReservation(int $row, int $column): void
    {

    }

    public function getSeatMap(array $room): array
    {

    }

    public function setMovie(array $movie): void
    {

    }

    public function setMoviePlan(): void
    {

    }

    public function removeMovieFromDisplayTimePlan(float $time): void
    {

    }

    public function toArray(): array
    {
        $room = [
            'rows' => $this->rows,
            'columns' => $this->columns,
            'roomName' => $this->RoomName,
            'roomSeatMap' => $this->roomSeatMap,
            'displayTimes' => $this->displayTimes
        ];

        return $room;

    }

    public function toString(): string
    {

    }
    public static function createRoomFromArray():Room
    {

    }
    public static function createRoomFromConsole():Room
    {

    }

}