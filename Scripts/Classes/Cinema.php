<?php


class Cinema
{
    private array $cinema = [];
    private string $filename = '';
    private array $timePlan = [];

    public function addRoom(): Room
    {
        return null;
    }

    public function setTimePlan(): void
    {
        return null;
    }

    /**
     * @param string $filename
     */
    public function setFilename(string $filename): void
    {
        $this->filename = $filename;
    }

    public function saveData(): void
    {
        file_put_contents($this->filename,$this->encodeData($this->cinema));
    }

    public function loadData(): array
    {
        return $this->decodeData(file_get_contents($this->filename));
    }

    public function decodeData($json): array
    {
        return json_decode($json, JSON_OBJECT_AS_ARRAY);
    }

    public function encodeData($data): string
    {
        return json_encode($data);
    }

    public function createFromArray(): Cinema
    {
        return null;
    }

}