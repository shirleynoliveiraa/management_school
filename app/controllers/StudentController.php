<?php
require_once '../app/models/Student.php';

class StudentController {
    public function list() {
        if (session_status() === PHP_SESSION_NONE) {
          session_start();
        }

        $student = new Student();
        $students = $student->readAll();
        include '../app/views/students/list.php';
    }

    public function create() {
        if (session_status() === PHP_SESSION_NONE) {
          session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $student = new Student();
            $student->name = $_POST['name'];
            $student->birth_date = $_POST['birth_date'];
            $student->username = $_POST['username'];

            $errors = $this->validateStudentData($student);

            if (!empty($errors)) {
                $this->displayErrors($errors);
                include '../app/views/students/create.php';
                return;
            }

            if ($student->create() === true) {
                header('Location: /public/index.php?action=list');
                exit();
            } else {
                  session_start();
                  $_SESSION['error_message'] = "O username já está em uso. Por favor, escolha outro.";
                  header('Location: /public/index.php?action=list');
                  exit();
              } 
          } else {
            include '../app/views/students/create.php';
        }
    }

    public function edit($id) {
        $studentModel = new Student();
        $studentData = $studentModel->readById($id);

        if (!$studentData) {
            echo "Aluno não encontrado!";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $studentModel->id = $id;
            $studentModel->name = $_POST['name'];
            $studentModel->birth_date = $_POST['birth_date'];
            $studentModel->username = $_POST['username'];

            $errors = $this->validateStudentData($studentModel);

            if (!empty($errors)) {
                $this->displayErrors($errors);
                include '../app/views/students/edit.php';
                return;
            }

            if ($studentModel->update()) {
                header('Location: /public/index.php?action=list');
                exit();
            } else {
                echo "Erro ao atualizar aluno.";
            }
        } else {
            include '../app/views/students/edit.php';
        }
    }

    public function delete($id) {
        if (session_status() === PHP_SESSION_NONE) {
          session_start();
        }

        $student = new Student();
        $student->id = $id;

        if ($student->delete()) {
            header('Location: /public/index.php?action=list');
        } else {
            echo "Erro ao excluir aluno.";
        }
    }

    private function validateStudentData($student) {
        $errors = [];

        if (strlen($student->name) < 3) {
            $errors[] = "O nome deve ter pelo menos 3 caracteres.";
        }

        if (empty($student->name) || empty($student->birth_date) || empty($student->username)) {
            $errors[] = "Todos os campos são obrigatórios.";
        }

        return $errors;
    }

    private function displayErrors(array $errors) {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>{$error}</div>";
        }
    }
}
