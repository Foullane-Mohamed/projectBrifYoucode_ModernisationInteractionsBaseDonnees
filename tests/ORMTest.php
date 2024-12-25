<?php

use PHPUnit\Framework\TestCase;

class ORMTest extends TestCase
{
    protected $orm;

    protected function setUp(): void
    {
        // Initialize the ORM instance before each test
        $this->orm = new ORM();
    }

    public function testCreate()
    {
        // Test creating a new record
        $data = ['name' => 'Test Player', 'position' => 'Forward'];
        $result = $this->orm->create('ExampleModel', $data);
        $this->assertTrue($result);
    }

    public function testRead()
    {
        // Test reading a record
        $record = $this->orm->read('ExampleModel', 1);
        $this->assertNotNull($record);
        $this->assertEquals('Test Player', $record['name']);
    }

    public function testUpdate()
    {
        // Test updating a record
        $data = ['name' => 'Updated Player'];
        $result = $this->orm->update('ExampleModel', 1, $data);
        $this->assertTrue($result);
    }

    public function testDelete()
    {
        // Test deleting a record
        $result = $this->orm->delete('ExampleModel', 1);
        $this->assertTrue($result);
    }

    public function testValidation()
    {
        // Test validation mechanism
        $data = ['name' => '', 'position' => 'Forward'];
        $result = $this->orm->create('ExampleModel', $data);
        $this->assertFalse($result); // Expecting validation to fail
    }

    protected function tearDown(): void
    {
        // Clean up after each test
        unset($this->orm);
    }
}