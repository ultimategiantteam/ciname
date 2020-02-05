<?php


namespace Cinema;


class Cinema
{
    public static $movies;
    public static $shows;
    public static $rooms;
    public static $reservations;

    protected string $moviesFile = __DIR__ . '/movies.json';
    protected string $showsFile = __DIR__ . '/shows.json';
    protected string $roomsFile = __DIR__ . '/rooms.json';
    protected string $reservationsFile = __DIR__ . '/reservations.json';


    public function d():void
    {


        static::$movies = Collection::load($this->moviesFile, Movie::class);
        static::$rooms = Collection::load($this->roomsFile, Room::class);
        static::$shows = Collection::load($this->showsFile, Show::class);
        static::$reservations = Collection::load($this->reservationsFile, Reservation::class);
    }





}