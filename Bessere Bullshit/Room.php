<?php
require_once 'Item.php';

class Room extends Item
{
    private string $name = '';
    private int $cols;
    private int $rows;

    /**
     * @param mixed $cols
     */
    public function setCols($cols): void
    {
        $this->cols = $cols;
    }

    /**
     * @param mixed $rows
     */
    public function setRows($rows): void
    {
        $this->rows = $rows;
    }

    public static function createFromConsole(): self
    {
        print 'Creating a new Room' . PHP_EOL;

        $instance = new static;
        print "\tName: ";
        $instance->setName(readline());
        print "\tColumns: ";
        $instance->setCols(readline());
        print "\tRows: ";
        $instance->setRows(readline());
        return $instance;
    }

    public static function createFromArray(array $data): self
    {
        $instance = parent::createFromArray($data);
        $instance->name = $data['name'];
        $instance->cols = $data['cols'];
        $instance->rows = $data['rows'];
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
     * @return mixed
     */
    public function getCols(): int
    {
        return $this->cols;
    }

    /**
     * @return mixed
     */
    public function getRows(): int
    {
        return $this->rows;
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
        return array_merge(parent::toArray(), ['name' => $this->getName(), 'rows' => $this->getRows(), 'cols' => $this->getCols()]);
    }
}