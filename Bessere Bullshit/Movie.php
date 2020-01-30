<?php


class Movie extends Item
{
    private string $name;

    public function toArray(): array
    {
        return array_merge(parent::toArray(), ['name' => $this->name]);
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }


    public static function createFromConsole(): self
    {
        $instance = new static;
        print 'Name: ';
        $instance->setName(readline());
        return $instance;
    }

    public static function createFromArray(array $data): self
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


}