<?php
require_once 'models/Enrollment.php';
require_once 'models/Student.php';
require_once 'models/Class.php';

class EnrollmentController {
  public function enroll() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $enrollment = new Enrollment();
        $enrollment->student_id = $_POST['student_id'];
        $enrollment->class_id = $_POST['class_id'];

        if ($enrollment->create()) {
            header('Location: index.php?action=list_enrollments');
            exit();
        } else {
            // Error message
            $errorMessage = "Erro ao matricular o aluno. O aluno já está matriculado nesta turma.";
            
            // Retreivind students to fill out the form
            $studentModel = new Student();
            $students = $studentModel->readAll();

            $classModel = new ClassModel();
            $classes = $classModel->readAll();

            include 'views/enrollment/create.php';
        }
    } else {
        // Retreivind students to fill out the form
        $studentModel = new Student();
        $students = $studentModel->readAll();

        $classModel = new ClassModel();
        $classes = $classModel->readAll();

        include 'views/enrollment/create.php';
    }
}

    public function list() {
        $enrollmentModel = new Enrollment();
        $enrollments = $enrollmentModel->readAll();
        include 'views/enrollment/list.php';
    }

    public function studentsInClass($class_id) {
        $enrollmentModel = new Enrollment();
        $students = $enrollmentModel->readStudentsInClass($class_id);
        include 'views/enrollment/students_in_class.php';
    }
}
