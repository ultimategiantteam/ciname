<?php


class Movie
{
    private $movieName = '';
    private $displayTimes = [];
    private $displayRooms = [];

    public static function createMovie(string $moviename): Movie
    {
        $movie = new static();
        $movie->setMovieName($moviename);
    }

    public function addDisplayTime(): void
    {
    }

    public function removeDisplay(): void
    {
    }

    public function getDisplayTimes(): array
    {
    }

    public function timesToString(): string
    {
    }

    public function setMovieName(string $moviename): void
    {
        $this->movieName = $moviename;
    }

    public function toArray(): array
    {
    }


}