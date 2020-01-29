<?php


class Presentation
{
    private Movie $movie;
    private Room $room;
    private string $time = '';

    public function setMovie(int $id, array $data, string $roomname, string $time): void
    {
        $movie = Movie::createFromArray($data['movies'][$id]);
        $this->movie = $movie;
        $this->room = Room::createFromArray($data,$roomname);
        $this->time = $time;
    }


}