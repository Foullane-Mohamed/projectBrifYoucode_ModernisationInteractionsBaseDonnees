<?php
namespace App\Crud\Controllers;

use App\Crud\Interfaces\CrudInterface;
use App\Exceptions\CrudException;

abstract class CrudController implements CrudInterface 
{
    protected $model;
    protected $table;

    public function __construct()
    {
        if (!$this->table) {
            throw new CrudException("Table name not defined");
        }
    }

    public function create(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (\Exception $e) {
            throw new CrudException("Create operation failed: " . $e->getMessage());
        }
    }

    public function read($id)
    {
        try {
            return $this->model->find($id);
        } catch (\Exception $e) {
            throw new CrudException("Read operation failed: " . $e->getMessage());
        }
    }

    public function update($id, array $data)
    {
        try {
            return $this->model->update($id, $data);
        } catch (\Exception $e) {
            throw new CrudException("Update operation failed: " . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            return $this->model->delete($id);
        } catch (\Exception $e) {
            throw new CrudException("Delete operation failed: " . $e->getMessage());
        }
    }

    public function all()
    {
        try {
            return $this->model->all();
        } catch (\Exception $e) {
            throw new CrudException("Fetch all operation failed: " . $e->getMessage());
        }
    }
}