<?php
namespace MySql\DataMapper;

use PDO;

class Storage
{
    public array $data = [];
    private PDO $link;

    public function __construct($link)
    {
        $this->link = $link;
        $this->data = $this->query("select* from Friends");
    }

    public function execute($sql) : void
    {
        $sth = $this->link->prepare($sql);
        $sth->execute();
        $this->data = $this->query("select* from Friends");
    }

    private function query($sql): array
    {
        $sth = $this->link->prepare($sql);
        $sth->execute();

        $result = $sth->fetchAll(PDO::FETCH_ASSOC);

        if ($result === false)
            return [];

        return  $result;
    }
}