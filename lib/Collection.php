<?php
namespace Cinema;

use ArrayObject;


/**
 * Class Collection
 * @package Cinema
 */
class Collection extends ArrayObject implements Persistable
{
    public static function load(string $filename, $class = Entity::class): self
    {
        $instance = new static;

        if (file_exists($filename)) {
            $json = json_decode(file_get_contents($filename), JSON_OBJECT_AS_ARRAY);
            foreach ($json as $data) $instance->append($class::createFromArray($data));
        }

        return $instance;
    }

    public function persist(string $filename): void
    {
        $data = [];
        foreach ($this as $item) if ($item instanceof Entity) $data[] = $item->toArray();
        file_put_contents($filename, json_encode($data));
    }

    public function find($id) {
        foreach ($this as $item) if($item->getId() == $id) return $item;

        return null;
    }
}