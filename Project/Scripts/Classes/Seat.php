<?php

class Seat
{
    private bool $reserved = false;
    private int $seatID = 0;

    public function changeReservation(): void
    {
        $this->reserved = !$this->reserved;
    }

    /**
     * @param int $id
     */
    public function setSeatID(int $id): void
    {
        $this->seatID = $id;
    }
}