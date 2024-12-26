<?php
namespace App\Crud\Operations;

trait Update 
{
    public function update($id, array $data)
    {
        $this->validateData($data);
        
        $sets = array_map(function($key) {
            return "$key = ?";
        }, array_keys($data));
        
        $query = "UPDATE {$this->table} SET " . implode(',', $sets) . " WHERE id = ?";
        
        return $this->executeQuery($query, [...array_values($data), $id]);
    }
}