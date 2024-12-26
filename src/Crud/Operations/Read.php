<?php
namespace App\Crud\Operations;

trait Read 
{
    public function read($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = ?";
        return $this->executeQuery($query, [$id])->fetch();
    }

    public function all()
    {
        $query = "SELECT * FROM {$this->table}";
        return $this->executeQuery($query)->fetchAll();
    }
}