<?php

/**
 * Class Cinema
 */
class Cinema
{
    private $shows = [];

    /**
     * @var Room[]
     */
    private $rooms = [];

    public static function createFromFile(string $filename)
    {
        if (!file_exists($filename)) return new static;
        return static::createFromArray(json_decode(file_get_contents($filename), JSON_OBJECT_AS_ARRAY));
    }

    public static function createFromArray(array $data)
    {
        $instance = new static;

        foreach ($data['rooms'] as $room) {
            $instance->addRoom(Room::createFromArray($room));
        }

        return $instance;
    }

    public function addRoom(Room $room): self
    {
        $this->rooms[] = $room;
        return $this;
    }

    /**
     * @return Room[]
     */
    public function getRooms(): array
    {
        return $this->rooms;
    }

    public function getRoom(int $id): Room
    {
        return $this->rooms[$id];
    }

    public function toArray()
    {
        $data = [
            'rooms' => [],
            'shows' => [],
        ];

        foreach ($this->getRooms() as  $room) {
            $data['rooms'][] = $room->toArray();
        }

        return $data;
    }

    public function toJson()
    {
        return json_encode($this->toArray());
    }

    public function persist(string $filename)
    {
        file_put_contents($filename, $this->toJson());
        return $this;
    }
}