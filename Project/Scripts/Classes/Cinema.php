<?php


class Cinema
{
    private $rooms = [];
    private $presentations = ['awwdawda'];
    const props = ['rooms', 'presentations'];

    /**
     * @param string $filename
     */
    public function save(string $filename): void
    {
        $i = 0;
        $rawData = [];
        foreach ($this as $property) {
            $rawData[self::props[$i]] =
                $property;
            $i++;
        }

        file_put_contents($filename, json_encode($rawData));
    }

    /**
     * @param string $filename
     * @return Cinema
     */
    public static function createFromFile(string $filename): Cinema
    {
        $json = file_get_contents($filename);
        $data = json_decode($json, JSON_OBJECT_AS_ARRAY);
        $cinema = new Cinema();
        $cinema->rooms = $data['rooms'];
        $cinema->presentations = $data['presentations'];
        return $cinema;
    }

    public function addRoom(string $name, int $rows, int $columns): void
    {
        $room = new Room();
        $room->createSeatMap($rows, $columns);
        $room->setName($name);
        $this->rooms[$name] = $room->toArray();
    }


}