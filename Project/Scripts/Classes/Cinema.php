<?php


class Cinema
{
    private $rooms = [0 => 'Alpha', 1 => 'Beta'];
    private $presentations = ['awwdawda'];
    const props = ['rooms', 'presentations'];

    public function save(string $filename): void
    {
        $i = 0;
        $rawData = [];
        foreach ($this as $property) {
            $rawData[self::props[$i]] =
                $property;
            $i++;
        }

        file_put_contents($filename, json_encode($rawData));
    }

}