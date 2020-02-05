<?php

namespace Cinema;
/**
 * Class Movie
 * @package Cinema
 */
class Movie extends Entity
{
    private $name;

    private $time;

    private $fsk;

    public static function createFromArray(array $data)
    {
        $instance = parent::createFromArray($data);
        foreach (['name', 'time', 'fsk'] as $p) $instance->{$p} = $data[$p];
        return $instance;
    }

    public static function createFromConsole(string $name, string $time, int $fsk): self
    {
        $instance = new static;
        $instance->name = $name;
        $instance->time = $time;
        $instance->fsk = $fsk;
        return $instance;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @return mixed
     */
    public function getFsk()
    {
        return $this->fsk;
    }

    public function toArray(): array
    {
        return parent::toArray() + [
            'name' => $this->name,
            'time' => $this->time,
            'fsk' => $this->fsk,
        ];
    }
}