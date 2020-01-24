<?php
require_once 'Cinema.php';

class Room extends Cinema
{
    private string $RoomName = '';
    public array $roomSeatMap = [];
    private array $displayTimes = [];

    public function setRoomName(string $RoomName): void
    {
        $this->RoomName = $RoomName;
    }

    public function setRoomSeatMap(int $rows, int $columns):void
    {
        for ($x = 0;$x < $rows; $x++){
            for ($y = 0;$y < $columns; $y++){
                $this->roomSeatMap[$x] .= 'O';
            }
        }
    }

    public function getFreeSeats(array $room):int
    {

    }

    public function addReservation(int $row, int $column):void
    {

    }

    public function getSeatMap(array $room):array
    {

    }

    public function setMovie(array $movie):void
    {

    }

    public function setMoviePlan():void
    {

    }

    public function removeMovieFromDisplayTimePla(float $time): void
    {

    }

    public function toArray():array
    {

    }

    public function toString():string
    {

    }
    public static function createRoomFromArray():Room
    {

    }
    public static function createRoomFromConsole():Room
    {

    }

}