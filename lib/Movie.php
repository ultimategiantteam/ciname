<?php

namespace Cinema;
/**
 * Class Movie
 * @package Cinema
 */
class Movie extends Entity
{
    private $name;

    private $duration;

    private $fsk;

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @param mixed $duration
     */
    public function setDuration($duration): void
    {
        $this->duration = $duration;
    }

    /**
     * @param mixed $fsk
     */
    public function setFsk($fsk): void
    {
        $this->fsk = $fsk;
    }

    public static function createFromArray(array $data)
    {
        $instance = parent::createFromArray($data);
        foreach (['name', 'duration', 'fsk'] as $p) $instance->{$p} = $data[$p];
        return $instance;
    }


    public static function createFromConsole(string $name, string $duration, int $fsk): self
    {
        $instance = new static;
        $instance->name = $name;
        $instance->duration = $duration;
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
    public function getduration()
    {
        return $this->duration;
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
                'duration' => $this->duration,
                'fsk' => $this->fsk,
            ];
    }

    public function editMovie(): Movie
    {

    }

}