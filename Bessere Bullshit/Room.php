<?php


class Room extends Item
{
    private $name = '';

    public static function createFromConsole()
    {
        $instance = new static;
        print 'Name: ';
        $instance->setName(readline());
        return $instance;
    }

    public static function createFromArray(array $data)
    {
        $instance = parent::createFromArray($data);
        $instance->name = $data['name'];
        return $instance;
    }


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Room
     */
    public function setName(string $name): Room
    {
        $this->name = $name;
        return $this;
    }

    public function toArray(): array
    {
        return array_merge(parent::toArray(), ['name' => $this->getName()]);
    }
}