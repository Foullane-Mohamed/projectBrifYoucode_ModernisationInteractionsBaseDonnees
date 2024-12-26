<?php

namespace src\Core;

use src\Config\Database;
use src\Crud\Operations\Create;
use src\Crud\Operations\Read;
use src\Crud\Operations\Update;
use src\Crud\Operations\Delete;

class Model
{
  use Create, Read, Update, Delete;

  protected $table;
  protected $connection;

  public function __construct()
  {
    $this->connection = Database::getInstance()->getConnection();
  }

  protected function executeQuery($query, $params)
  {
    $stmt = $this->connection->prepare($query);
    $stmt->execute($params);
    return $stmt;
  }

  protected function validateData(array $data)
  {
    // Implement your validation logic here
  }
}
