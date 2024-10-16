<?php

require_once __DIR__ . '/../models/Class.php';
require_once __DIR__ . '/../config/database.php';

use PHPUnit\Framework\TestCase;

class ClassTest extends TestCase
{
    private $classModel;

    protected function setUp(): void
    {
        // Create a new ClassModel instance before each test
        $this->classModel = new ClassModel();
        
        // Clean up any existing entries with the same name
        $this->classModel->name = "Mathematics";
        $this->classModel->delete();
    }

    public function testClassCreation()
    {
        // Set class properties
        $this->classModel->name = "Mathematics";
        $this->classModel->description = "A basic mathematics class";
        $this->classModel->type = "Core";

        // Attempt to create the class
        $result = $this->classModel->create();

        // Assert that the result is true (class created successfully)
        $this->assertTrue($result);

        // Verify the class was actually inserted into the database
        $stmt = $this->classModel->readAll();
        $classes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function testClassUpdate()
    {
        // Create a class to update later
        $this->classModel->name = "Mathematics";
        $this->classModel->description = "A basic mathematics class";
        $this->classModel->type = "Core";
        $this->classModel->create();

        // Update the class properties
        $this->classModel->id = 1; 
        $this->classModel->name = "Advanced Mathematics";
        $this->classModel->description = "An advanced mathematics class";
        $this->classModel->type = "Elective";

        // Attempt to update the class
        $result = $this->classModel->update();

        // Assert that the update was successful
        $this->assertTrue($result);
    }

    public function testClassDeletion()
    {
        // Create a class to delete later
        $this->classModel->name = "Mathematics";
        $this->classModel->description = "A basic mathematics class";
        $this->classModel->type = "Core";
        $this->classModel->create();

        // Set the ID of the class to delete
        $this->classModel->id = 1; // Assuming this is the ID of the created class

        // Attempt to delete the class
        $result = $this->classModel->delete();

        // Assert that the deletion was successful
        $this->assertTrue($result);

        // Verify the class was actually deleted from the database
        $deletedClass = $this->classModel->readById(1);
        $this->assertFalse($deletedClass); // Should return false or null
    }

    protected function tearDown(): void
    {
        // Clean up the database after each test
        $this->classModel->name = "Mathematics";
        $this->classModel->delete();
    }
}
