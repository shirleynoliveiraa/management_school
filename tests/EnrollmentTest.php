<?php

require_once __DIR__ . '/../app/models/Enrollment.php';
require_once __DIR__ . '/../config/database.php';

use PHPUnit\Framework\TestCase;

class EnrollmentTest extends TestCase
{
    private $enrollment;
    private $studentId;
    private $classId;

    protected function setUp(): void
    {
        // Create a new Enrollment instance before each test
        $this->enrollment = new Enrollment();

        // Assuming you already have a student and class to enroll
        $this->studentId = 2; // Change this to a valid student ID in your database
        $this->classId = 10; // Change this to a valid class ID in your database
        
        // Clean up any existing enrollments for this student and class
        $this->enrollment->student_id = $this->studentId;
        $this->enrollment->class_id = $this->classId;
        $this->enrollment->deleteEnrollment();
    }

    public function testEnrollmentCreation()
    {
        // Attempt to create the enrollment
        $this->enrollment->student_id = $this->studentId;
        $this->enrollment->class_id = $this->classId;

        $result = $this->enrollment->create();

        // Assert that the result is true (enrollment created successfully)
        $this->assertTrue($result);

        // Verify the enrollment was actually inserted into the database
        $stmt = $this->enrollment->readAll();
        $enrollments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function testReadStudentsInClass()
    {
        // Create an enrollment to test the reading functionality
        $this->enrollment->student_id = $this->studentId;
        $this->enrollment->class_id = $this->classId;
        $this->enrollment->create();

        // Get students enrolled in the specified class
        $stmt = $this->enrollment->readStudentsInClass($this->classId);
        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Assert that we retrieve the correct student
        $this->assertCount(1, $students);
        $this->assertEquals($this->studentId, $students[0]['id']);
    }

    protected function tearDown(): void
    {
        // Clean up the database after each test
        $this->enrollment->student_id = $this->studentId;
        $this->enrollment->class_id = $this->classId;
        $this->enrollment->deleteEnrollment();
    }
}
