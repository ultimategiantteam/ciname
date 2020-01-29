<?php


class Presentation
{
    private Movie $movie;
    private Room $room;
    private string $time = '';

    public function setAttributes(int $movieId, array $data, string $roomName, string $time): void
    {
        $this->movie = Movie::createFromArray($data['movies'][$movieId]);
        $this->room = Room::createFromArray($data, $roomName);
        $this->time = $time;
    }

    public function toArray(): array
    {
        return [
            'movie' => $this->movie->toArray(),
            'room' => $this->room->toArray(),
            'time' => $this->time
        ];
    }

    public static function createFromArray(array $data):Presentation
    {
        $presentation = new Presentation();
        $presentation->movie = $data['movie'];
        $presentation->room = $data['room'];
        $presentation->time = $data['time'];

        return $presentation;
    }

}