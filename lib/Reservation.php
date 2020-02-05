<?php


namespace Cinema;


class Reservation extends Entity
{
    private string $name = "";
    private array $seats = [];
    private $show;

    public static function createFromArray(array $data)
    {
        $instance = parent::createFromArray($data);
        $instance->show = App::$shows->find($data['show']);
        foreach (['name', 'seats'] as $p) $instance->{$p} = $data[$p];
        return $instance;
    }

    public static function createFromConsole(string $name): Reservation
    {
        $instance = new static;
        $instance->name = $name;

        foreach (App::$shows as $id => $show) {
            printf("%d\t Room: %s\n\t Movie: %s\n\t Time: %s\n\n", $id, $show->getRoom()->getName(), $show->getMovie()->getName(), $show->getTime());
        }

        //Show auswählen
        do {
            print "Show #:";
            $input = readline();
        } while (array_key_exists($input, App::$shows) == false);
        $instance->show = App::$shows->offsetGet($input);
        $show = App::$shows[$input];

        $rows = $show->getRoom()->getRows();
        $columns = $show->getRoom()->getColumns();
        $instance->printSeats($input, $rows, $columns);

        print PHP_EOL . "How many seats: ";
        do {
            $seatsCount = trim(readline());
        } while ($seatsCount == 0 || is_numeric($seatsCount) == false);

        for ($i = 0; $i < $seatsCount; $i++) {
            do {
                print PHP_EOL . "Which row: ";
                $row = trim(readline());

                print PHP_EOL . "Which column: ";
                $column = trim(readline());

                $seat = $row * $columns + $column;
                if ($show->isSeatFree($seat) == true && $row <= $rows && $column <= $columns) {
                    $instance->seats[] = $seat;
                    $isFree = true;
                } else {
                    print PHP_EOL . "Non existing or taken seat" . PHP_EOL;
                    $isFree = false;
                }
            } while ($isFree == false);
        }

        return $instance;
    }

    public function toArray(): array
    {
        return parent::toArray() + ['show' => $this->show->getId(), 'name' => $this->getName(), 'seats' => $this->getSeats()];
    }

    /**
     * @return array
     */
    public function getSeats(): array
    {
        return $this->seats;
    }

    public function getShow()
    {
        return $this->show;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function printSeats(Show $show,int $rows, int $columns): void
    {
        for ($i = 0; $i < $rows; $i++) {
            for ($j = 0; $j < $columns; $j++) {
                $seat = $i * $columns + $j;
                if ($show->isSeatFree($seat) == true) print "O"; else print "X";
            }
            print PHP_EOL;
        }
    }

}