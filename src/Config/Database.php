<?php

namespace Config;

class Database
{
  private static $instance = null;
  private $connection;

  private $host = 'localhost';
  private $username = 'root';
  private $password = '';
  private $dbname = 'players';

  private function __construct()
  {
    $this->connection = new \PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
    $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
  }

  public static function getInstance()
  {
    if (self::$instance === null) {
      self::$instance = new Database();
    }
    return self::$instance;
  }

  public function getConnection()
  {
    return $this->connection;
  }
}