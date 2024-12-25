<?php

namespace ORM;

interface ORMInterface
{
    public function create(array $data);
    
    public function read($id);
    
    public function update($id, array $data);
    
    public function delete($id);
    
    public function all();
    
    public function find($criteria);
}