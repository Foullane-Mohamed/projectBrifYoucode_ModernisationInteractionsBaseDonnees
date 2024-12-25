<?php

namespace Core;

abstract class Model
{
    protected $attributes = [];
    protected $errors = [];

    public function __construct(array $data = [])
    {
        $this->fill($data);
    }

    public function fill(array $data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->attributes[$key] = $value;
            }
        }
    }

    public function get($key)
    {
        return $this->attributes[$key] ?? null;
    }

    public function set($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    public function validate()
    {
        // Implement validation logic here
        return empty($this->errors);
    }

    public function getErrors()
    {
        return $this->errors;
    }
}