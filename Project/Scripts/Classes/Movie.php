<?php


class Movie
{
    private string $name = '';
    private int $fsk = 0;

    public function setName(string $name):void
    {
        $this->name = $name;
    }

    public function setFsk(int $fsk): void
    {
        $this->fsk = $fsk;
    }


}