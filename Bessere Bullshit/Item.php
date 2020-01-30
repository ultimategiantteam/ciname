<?php
require_once 'Persistable.php';

abstract class Item implements Persistable
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


    public function toJson(): string
    {
        return json_encode($this->toArray());
    }
}