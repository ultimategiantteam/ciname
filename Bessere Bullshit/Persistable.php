<?php


interface Persistable
{
    public function toArray(): array;

    public function toJson(): string;
}