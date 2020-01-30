<?php


class Movie
{
    private string $name;

    public function __construct()
    {
        $this->name = readline();
    }
}