<?php

require_once __DIR__ . '/../models/Student.php';
require_once __DIR__ . '/../config/database.php';

use PHPUnit\Framework\TestCase;

class StudentTest extends TestCase
{
    private $student;
    private $username = "jane.doe";

    protected function setUp(): void
    {
        $this->student = new Student();
        
        // Clean up any existing entries with the same username
        $this->cleanupUser($this->username);
    }

    private function cleanupUser($username)
    {
        // Create an instance to check for existing users
        $existingStudent = new Student();
        $stmt = $existingStudent->readAll();
        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Loop through to find and delete existing user
        foreach ($students as $student) {
            if ($student['username'] === $username) {
                $existingStudent->id = $student['id']; // Set the ID of the existing user
                $existingStudent->delete(); // Delete the user
            }
        }
    }

    public function testStudentCreation()
    {
        // Set student properties
        $this->student->name = "Jane Doe";
        $this->student->birth_date = "2000-01-01";
        $this->student->username = $this->username;

        // Attempt to create the student
        $result = $this->student->create();

        // Assert that the result is true (student created successfully)
        $this->assertTrue($result);

        // Optionally, you can verify the student was actually inserted into the database
        $stmt = $this->student->readAll();
        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function tearDown(): void
    {
        // Clean up the database after each test
        $this->cleanupUser($this->username);
    }
}
