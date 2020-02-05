<?php
namespace Cinema;

/**
 * Interface Persistable
 * @package Cinema
 */
interface Persistable
{
    public function persist(string $filename): void;
}