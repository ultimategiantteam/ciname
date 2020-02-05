<?php

namespace Cinema;

class Room extends Entity
{
    private string $name;
    private int $columns;
    private int $rows;

    public static function createFromArray(array $data)
    {
        $instance = parent::createFromArray($data);
        foreach (['name', 'columns', 'rows', ] as $p) $instance->{$p} = $data[$p];
        return $instance;
    }

    public static function createFromConsole(string $name, int $columns, int $rows): Room
    {
        $instance = new static;
        $instance->name = $name;
        $instance->columns = $columns;
        $instance->rows = $rows;
        return $instance;
    }

    public function toArray(): array
    {
        return parent::toArray() + [
                'name' => $this->name,
                'columns' => $this->columns,
                'rows' => $this->rows,
            ];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getColumns(): int
    {
        return $this->columns;
    }

    /**
     * @return int
     */
    public function getRows(): int
    {
        return $this->rows;
    }
}
