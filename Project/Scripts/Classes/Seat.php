<?php


class Seat
{
    private bool $reserved = false;
    private int $seatID;

    public static function createSeat(): Seat
    {
        return new Seat();
    }



    public function setSeatID():void
    {

    }
}