<?php
namespace MySql\DataMapper;

use PDO;

class Storage
{
    public $data;
    private PDO $link;

    public function __construct($link)
    {
        $this->link = $link;
        $this->query("select* from Friends", [], Human::class);
    }

    public function execute($sql) : void
    {
        $sth = $this->link->prepare($sql);
        $sth->execute();
        $this->query("select* from Friends", [], Human::class);
    }

    public function query(string $sql, array $params, string $className = 'stdClass'): void
    {
        $sth = $this->link->prepare($sql);
        $result = $sth->execute($params);

        if (false === $result) {
            $this->data = null;
        }

        $this->data = $sth->fetchAll(\PDO::FETCH_CLASS, $className);
    }
}