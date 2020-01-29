<?php


class Movie
{
    private string $name = '';
    private int $fsk = 0;


    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setFsk(int $fsk): void
    {
        $this->fsk = $fsk;
    }


    public static function createMovie(string $name, int $fsk): Movie
    {
        $movie = new Movie();
        $movie->setName($name);
        $movie->setFsk($fsk);
        return $movie;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'fsk' => $this->fsk,
        ];
    }

    public static function createFromArray(array $data): Movie
    {
        $movie = new Movie();
        $movie->name = $data['name'];
        $movie->fsk = $data['fsk'];
        return $movie;
    }


}