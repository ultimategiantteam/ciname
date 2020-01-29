<?php
require_once 'Cinema.php';

class Room extends Cinema
{
    private $rows = 0;
    private $columns = 0;
    private $roomName = '';
    private $roomSeatMap = [];
    private $displayTimes = [];

    /**
     * @param string $RoomName
     */
    public function setRoomName(string $RoomName): void
    {
        $this->roomName = $RoomName;
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
    public function getSeatMapAsString(): string
    {
        $seatMap = ' ';
        $alphas = range('A', 'Z');
        for ($i = 0; $i < $this->columns; $i++) {
            $seatMap .= ' ' . $i;
        }
        $seatMap .= PHP_EOL;
        foreach ($this->roomSeatMap as $id => $value) {
            $seatMap .= $id . ' ';
            for ($i = 0; $i < $this->columns; $i++) {
                $seatMap .= $value[$i] . ' ';
            }
            $seatMap .= PHP_EOL;
        }
        return $seatMap;
    }

    public function getFreeSeats(array $room): int
    {

    }

    public function seatFree(int $row, int $column): bool
    {
        $seat = substr($this->roomSeatMap[$row], $column, 1);
        if ($seat == 'O') {
            return true;
        }
        return false;
    }

    public function addReservation(int $row, int $column): void
    {
        if ($this->seatFree($row, $column)) {
            $part1 = substr($this->roomSeatMap[$row],0,$column);
            $part2 = substr($this->roomSeatMap[$row],$column+1,strlen($this->roomSeatMap[$row]));


            $newrow = $part1 . 'X' . $part2;

            $this->roomSeatMap[$row] = $newrow;
        }


    }

    public function getSeatMap(array $room): array
    {
        return $this->roomSeatMap;
    }

    /**
     * @param string $movieName
     * @param string $movieTime
     */
    public function addMovie(string $movieName, string $movieTime): void
    {
        $this->displayTimes[$movieTime] = $movieName;
    }

    public function removeMovieFromDisplayTimePlan(float $time): void
    {

    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'rows' => $this->rows,
            'columns' => $this->columns,
            'roomName' => $this->roomName,
            'roomSeatMap' => $this->roomSeatMap,
            'displayTimes' => $this->displayTimes
        ];
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        $room = '';
        $room .= $this->roomName . PHP_EOL;
        foreach ($this->displayTimes as $time => $movieName) {
            $room .= $movieName . ' am ' . $time . PHP_EOL;
        }
        return $room;
    }

    public static function createRoomFromArray(array $data): Room
    {

    }

    public static function createRoomFromConsole(string $roomName, int $rows, int $columns): Room
    {
        $room = new Room();
        $room->roomName = $roomName;
        $room->setRoomSeatMap($rows, $columns);
        return $room;
    }

}