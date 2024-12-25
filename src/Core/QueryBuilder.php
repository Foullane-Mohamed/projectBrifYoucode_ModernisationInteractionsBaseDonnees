<?php

namespace Core;

class QueryBuilder
{
    protected $query;
    protected $table;

    public function table($table)
    {
        $this->table = $table;
        return $this;
    }

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

    public function update(array $data)
    {
        $set = implode(', ', array_map(function ($key, $value) {
            return "{$key} = '{$value}'";
        }, array_keys($data), $data));

        $this->query = "UPDATE {$this->table} SET {$set}";
        return $this;
    }

    public function delete()
    {
        $this->query = "DELETE FROM {$this->table}";
        return $this;
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function execute()
    {
        // Here you would execute the query against the database
        // This is a placeholder for actual database execution logic
    }
}