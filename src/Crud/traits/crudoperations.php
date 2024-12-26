<?php
namespace App\Crud\Traits;

use App\Crud\Operations\Create;
use App\Crud\Operations\Read;
use App\Crud\Operations\Update;
use App\Crud\Operations\Delete;

trait CrudOperations 
{
    use Create, Read, Update, Delete;

    protected function executeQuery($query, array $params = [])
    {
        try {
            $stmt = $this->connection->prepare($query);
            $stmt->execute($params);
            return $stmt;
        } catch (\PDOException $e) {
            throw new \Exception("Query execution failed: " . $e->getMessage());
        }
    }
}