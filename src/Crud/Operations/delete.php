<?php
namespace src\Crud\Operations;

trait Delete
{
    public function delete($id)
    {
        $query = "DELETE FROM {$this->table} WHERE id = ?";
        return $this->executeQuery($query, [$id]);
    }
}