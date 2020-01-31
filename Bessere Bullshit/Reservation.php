<?php


class Reservation extends Item
{
    private string $name;

    public static function createFromArray(array $data): Reservation
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
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public static function createFromConsole(): Reservation
    {
        $instance = new static;
        print 'Creating a new Reservation' . PHP_EOL;
        print "\tName: ";
        $instance->setName(readline());
        return $instance;
    }

    public function toArray(): array
    {
        return array_merge(parent::toArray(),['name' => $this->getName()]);
    }
}