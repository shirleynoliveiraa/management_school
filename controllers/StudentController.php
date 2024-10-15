<?php
require_once 'models/Student.php';

class StudentController {
    public function list() {
        $student = new Student();
        $students = $student->readAll();
        include 'views/students/list.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $student = new Student();
            $student->name = $_POST['name'];
            $student->birth_date = $_POST['birth_date'];
            $student->username = $_POST['username'];

            // Validação
            $errors = $this->validateStudentData($student);

            if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>{$error}</div>";
                }
                include 'views/students/create.php'; // Reexibe o formulário com os erros
                return;
            }

            // Se não houver erros, tenta criar o aluno
            if ($student->create()) {
                header('Location: index.php');
                exit();
            } else {
                echo "Erro ao cadastrar aluno.";
            }
        } else {
            include 'views/students/create.php';
        }
    }

    public function edit($id) {
        $studentModel = new Student();
        $studentData = $studentModel->readById($id); // Supondo que este método retorne os dados do aluno

        if (!$studentData) {
            echo "Aluno não encontrado!";
            return; // Sai da função se não encontrar o aluno
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Atualiza o aluno
            $studentModel->id = $id;
            $studentModel->name = $_POST['name'];
            $studentModel->birth_date = $_POST['birth_date'];
            $studentModel->username = $_POST['username'];

            // Validação
            $errors = $this->validateStudentData($studentModel);

            if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>{$error}</div>";
                }
                include 'views/students/edit.php'; // Reexibe o formulário com os erros
                return;
            }

            // Se não houver erros, tenta atualizar o aluno
            if ($studentModel->update()) {
                header('Location: index.php');
                exit(); // Adicione exit após redirecionar
            } else {
                echo "Erro ao atualizar aluno.";
            }
        } else {
            // Passa os dados do aluno para a view
            include 'views/students/edit.php';
        }
    }

    public function delete($id) {
        $student = new Student();
        $student->id = $id;

        if ($student->delete()) {
            header('Location: index.php');
        } else {
            echo "Erro ao excluir aluno.";
        }
    }

    // Método para validar os dados do aluno
    private function validateStudentData($student) {
        $errors = [];

        // RN02: Validar se o nome possui no mínimo 3 caracteres
        if (strlen($student->name) < 3) {
            $errors[] = "O nome deve ter pelo menos 3 caracteres.";
        }

        // RN03: Validar se todos os campos foram preenchidos
        if (empty($student->name) || empty($student->birth_date) || empty($student->username)) {
            $errors[] = "Todos os campos são obrigatórios.";
        }

        return $errors;
    }
}
