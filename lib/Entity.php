<?php
namespace Cinema;

/**
 * Class Entity
 * @package Cinema
 */
abstract class Entity implements Persistable
{
    private $id;

    public static function createFromArray(array $data)
    {
        $instance = new static;
        $instance->id = $data['id'];
        return $instance;
    }

    public function __construct()
    {
        $this->id = uniqid();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    public function toArray(): array
    {
        return ['id' => $this->id];
    }

    public function persist(string $filename): void
    {
        file_put_contents($filename, json_encode($this->toArray()));
    }
}