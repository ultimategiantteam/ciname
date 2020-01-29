<?php


class Seat
{
    private bool $reserved = false;
    private int $Id;

    private function setGetId(int $Id):int
    {
        $this->Id = $Id;
        return $this->Id;
    }

    public function changeReserved():void
    {
        $this->reserved = !$this->reserved;
    }

    public function toArray(int $seatId):array
    {
        return [
            'reserved' => $this->reserved,
            'id' => $this->setGetId($seatId)
        ];
    }
}