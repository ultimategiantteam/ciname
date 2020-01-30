<?php

/**
 * Class Cinema
 */
class Cinema
{
    /**
     * @var Show[]
     */
    private $shows = [];

    /**
     * @var Room[]
     */
    private $rooms = [];

    /**
     * @var Movie[]
     */
    private $movies = [];

    /**
     * @param string $filename
     * @return static
     */
    public static function createFromFile(string $filename)
    {
        if (!file_exists($filename)) return new static;
        return static::createFromArray(json_decode(file_get_contents($filename), JSON_OBJECT_AS_ARRAY));
    }

    /**
     * @param array $data
     * @return static
     */
    public static function createFromArray(array $data)
    {
        $instance = new static;

        foreach ($data['rooms'] as $room) {
            $instance->addRoom(Room::createFromArray($room));
        }

        return $instance;
    }

    /**
     * @param \Room $room
     * @return $this
     */
    public function addRoom(Room $room): self
    {
        $this->rooms[] = $room;
        return $this;
    }

    public function addShow(Show $show): self
    {
        $this->shows[] = $show;
        return $this;
    }

    /**
     * @return Room[]
     */
    public function getRooms(): array
    {
        return $this->rooms;
    }

    /**
     * @param int $id
     * @return \Room
     */
    public function getRoom(int $id): Room
    {
        return $this->rooms[$id];
    }

    /**
     * @return \Movie[]
     */
    public function getMovies(): array
    {
        return $this->movies;
    }

    public function addMovie(Movie $movie): self
    {
        $this->movies[] = $movie;
        return $this;
    }


    /**
     * @return array
     */
    public function toArray()
    {
        $data = [
            'rooms' => [],
            'shows' => [],
        ];

        foreach ($this->getRooms() as $room) {
            $data['rooms'][] = $room->toArray();
        }

        return $data;
    }

    /**
     * @return false|string
     */
    public function toJson()
    {
        return json_encode($this->toArray());
    }

    /**
     * @param string $filename
     * @return $this
     */
    public function persist(string $filename)
    {
        file_put_contents($filename, $this->toJson());
        return $this;
    }
}