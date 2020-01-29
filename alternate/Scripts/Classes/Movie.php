<?php


class Movie
{
    private $movieName = '';

    public static function createMovie(string $moviename): Movie
    {
        $movie = new static();
        $movie->setMovieName($moviename);
    }


    public function setMovieName(string $moviename): void
    {
        $this->movieName = $moviename;
    }




}