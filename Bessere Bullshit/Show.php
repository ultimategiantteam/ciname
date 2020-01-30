<?php


class Show extends Item
{
    private $room;

    private $movie;

    private $time;

    /**
     * @return mixed
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * @param mixed $room
     * @return Show
     */
    public function setRoom(Room $room)
    {
        $this->room = $room;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMovie()
    {
        return $this->movie;
    }

    /**
     * @param mixed $movie
     * @return Show
     */
    public function setMovie(Movie $movie)
    {
        $this->movie = $movie;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param mixed $time
     * @return Show
     */
    public function setTime($time)
    {
        $this->time = $time;
        return $this;
    }

    public function toArray(): array
    {
        return array_merge(parent::toArray(), ['room' => $this->getRoom(), 'movie' => $this->getMovie()]);
    }

    public static function createFromConsole(): Show
    {
        $instance = new static;
        $movies = (new Cinema())->getMovies();
        foreach ($movies as $id => $movie){
            print "$id $movie";
        }
        $instance->movie = $instance->setMovie(readline());

        $instance->room = $instance->setRoom(readline());
        $instance->time = $instance->setTime(readline());





        return $instance;

    }

}