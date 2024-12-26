<?php
namespace src\Crud\Operations;

trait Read
{
    public function read($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = ?";
        return $this->executeQuery($query, [$id])->fetch();
    }
}