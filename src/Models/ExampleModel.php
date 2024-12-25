<?php

namespace App\Models;

use App\Core\Model;

class ExampleModel extends Model
{
    protected $table = 'example_table'; // Specify the corresponding database table
    protected $fillable = ['name', 'description']; // Specify the fillable properties

    // Example method to demonstrate functionality
    public function getExampleData()
    {
        return $this->all(); // Retrieve all records from the example_table
    }

    // Additional methods specific to ExampleModel can be added here
}