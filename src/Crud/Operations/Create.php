<?php
namespace App\Crud\Operations;

trait Create 
{
    public function create(array $data)
    {
        $this->validateData($data);
        
        $columns = implode(',', array_keys($data));
        $values = implode(',', array_fill(0, count($data), '?'));
        
        $query = "INSERT INTO {$this->table} ($columns) VALUES ($values)";
        
        return $this->executeQuery($query, array_values($data));
    }

    protected function validateData(array $data)
    {
        // Implémentation de la validation
    }
}