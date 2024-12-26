<?php
namespace src\Crud\Operations;

trait Create
{
    public function create(array $data)
    {
        $this->validateData($data);

        $columns = implode(',', array_keys($data));
        $placeholders = implode(',', array_fill(0, count($data), '?'));

        $query = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";

        return $this->executeQuery($query, array_values($data));
    }
}