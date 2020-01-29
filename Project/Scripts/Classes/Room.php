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
        for ($x = 0; $x < $rows; $x++) {
            for ($y = 0; $y < $cols; $y++) {
                $this->seats .= Seat::createSeat();
            }
        }
    }
}