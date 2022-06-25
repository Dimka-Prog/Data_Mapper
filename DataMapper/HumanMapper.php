<?php

namespace MySql\DataMapper;

use PDO;

class HumanMapper
{
    public Storage $storage;
    private PDO $link;

    public function __construct()
    {
        $dsn = 'mysql:host=localhost;dbname=PDO_MySql';
        $this->link = new PDO($dsn, 'admin', 'password');
        $this->storage = new Storage($this->link);
    }

    public function addValue(string $name, int $age): void
    {
        $this->storage->execute("insert into Friends values (default, '$name', $age)");
    }

    public function deleteValue(int $id): void
    {
        $this->storage->execute("DELETE from Friends where id = $id");
        $this->storage->execute("UPDATE Friends SET id = $id where id = $id + 1");
    }

    public function find(int $id) : string
    {
        if ($id > 0) {
            $this->storage->query("SELECT* from Friends where id = $id", [], Human::class);

            $name = $this->storage->data->nameFriend;
            $age = $this->storage->data->age;
            return $name . ' ' . $age . PHP_EOL;
        }
        return "По данному значению ничего не найдено<br>";
    }

    public function getValue($value) : string
    {
        $friends = $this->storage->data;

        if (is_string($value))
        {
            $infoFriend = "";
            foreach ($friends as $friend)
            {
                if ($friend->nameFriend === $value)
                    $infoFriend .= $friend->nameFriend . ' ' . $friend->age . ' ';
            }

            if ($infoFriend !== "")
                return "$infoFriend";
        }

        if (is_int($value))
        {
            $infoFriend = "";
            foreach ($friends as $friend)
            {
                if ($friend->age == $value)
                    $infoFriend .= $friend->nameFriend . ' ' . $friend->age . ' ';
            }

            if ($infoFriend !== "")
                return "$infoFriend";
        }

        return 'Ничего не найдено' . PHP_EOL;
    }

    public function getAll(): array
    {
        return $this->storage->data;
    }

}