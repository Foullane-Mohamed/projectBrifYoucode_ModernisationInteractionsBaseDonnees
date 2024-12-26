<?php
namespace src\Core;

class QueryBuilder
{
    protected $table;
    protected $query;

    public function select($columns = '*')
    {
        $this->query = "SELECT {$columns} FROM {$this->table}";
        return $this;
    }

    public function where($column, $operator, $value)
    {
        $this->query .= " WHERE {$column} {$operator} '{$value}'";
        return $this;
    }

    public function insert(array $data)
    {
        $columns = implode(', ', array_keys($data));
        $values = implode(', ', array_map(function ($value) {
            return "'{$value}'";
        }, array_values($data)));

        $this->query = "INSERT INTO {$this->table} ({$columns}) VALUES ({$values})";
        return $this;
    }

    public function update($id, array $data)
    {
        $sets = array_map(function($key) {
            return "$key = ?";
        }, array_keys($data));

        $this->query = "UPDATE {$this->table} SET " . implode(',', $sets) . " WHERE id = ?";
        return $this;
    }

    public function delete($id)
    {
        $this->query = "DELETE FROM {$this->table} WHERE id = {$id}";
        return $this;
    }

    public function getQuery()
    {
        return $this->query;
    }
}