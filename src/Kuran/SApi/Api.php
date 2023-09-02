<?php

namespace Kuran\SApi;

use \PDO;

class Api
{

    private string $queryString;
    private array $queryData = [];

    public function __construct(private PDO $database)
    {

    }

    public function readAll(array $params): string{

        $statement = $this->getData($params);

        $this->queryData = [];
        $this->queryData["Count"] = $statement->rowCount();
        $this->queryData["Data"] = $statement->fetchall();
        
        return json_encode($this->queryData, JSON_PRETTY_PRINT);
    }

    public function readOne(array $params): string{
        $statement = $this->getData($params);

        $this->queryData = [];
        $this->queryData["Count"] = $statement->rowCount();
        $this->queryData["Data"] = $statement->fetch();
        
        return json_encode($this->queryData, JSON_PRETTY_PRINT);
    }

    public function create(array $params): string{
        $statement = $this->getData($params);

        $this->queryData = [];
        $this->queryData["Count"] = $statement->rowCount();
        $this->queryData["Last Index"] = $this->database->lastInsertId();

        return json_encode($this->queryData, JSON_PRETTY_PRINT);
    }

    public function update(array $params): string{
        $statement = $this->database->prepare($this->queryString);

        $statement->execute($params);

        $this->queryData = [];
        $this->queryData["Count"] = $statement->rowCount();

        return json_encode($this->queryData, JSON_PRETTY_PRINT);
    }

    public function delete(array $params): string{
        $statement = $this->getData($params);

        $this->queryData = [];
        $this->queryData["Count"] = $statement->rowCount();
        
        return json_encode($this->queryData, JSON_PRETTY_PRINT);
    }


    // More to be done ??
    public function setQueryString(string $query){
        $this->queryString = $query;
    }

    private function getData(array $params){
        $statement = $this->database->prepare($this->queryString);

        $statement->execute($params);

        return $statement;
    }
}