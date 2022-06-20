<?php

namespace MySql\DataMapper;

class Repository
{
    private HumanMapper $dataMapper;

    public function __construct()
    {
        $this->dataMapper = new HumanMapper();
    }

    public function addHuman(string $name, int $age): void
    {
        $this->dataMapper->addValue($name, $age);
    }

    public function delHuman(int $id): void
    {
        $this->dataMapper->deleteValue($id);
    }

    public function findById(int $id): string
    {
        return $this->dataMapper->find($id);
    }

    public function findByValue($value) : string
    {
        return $this->dataMapper->getValue($value);
    }

    public function findAll(): void
    {
        $arrFriends = $this->dataMapper->getAll();

        foreach ($arrFriends as $friend)
        {
            $id = "<td> {$friend['id']} </td>";
            $name = "<td> {$friend['nameFriend']} </td>";
            $age = "<td> {$friend['age']} </td>";
            echo "<tr> $id $name $age </tr>";
        }
    }


}