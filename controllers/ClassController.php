<?php
require_once 'models/Class.php';

class ClassController {
    public function list($page = 1) {
        $classModel = new ClassModel();
        $limit = 5;
        $offset = ($page - 1) * $limit;
        $classes = $classModel->readAll($offset, $limit);
        $totalClasses = $classModel->count();
        $totalPages = ceil($totalClasses / $limit);

        include 'views/classes/list.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $class = new ClassModel();
            $class->name = $_POST['name'];
            $class->description = $_POST['description'];
            $class->type = $_POST['type'];

            // Validação
            $errors = $this->validateClassData($class);

            if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>{$error}</div>";
                }
                include 'views/classes/create.php'; // Reexibe o formulário com os erros
                return;
            }

            if ($class->create()) {
                header('Location: index.php?action=list_classes');
                exit();
            } else {
                echo "Erro ao cadastrar a turma.";
            }
        } else {
            include 'views/classes/create.php';
        }
    }

    public function edit($id) {
        $classModel = new ClassModel();
        $classData = $classModel->readById($id);

        if (!$classData) {
            echo "Turma não encontrada!";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $classModel->id = $id;
            $classModel->name = $_POST['name'];
            $classModel->description = $_POST['description'];
            $classModel->type = $_POST['type'];

            // Validação
            $errors = $this->validateClassData($classModel);

            if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>{$error}</div>";
                }
                include 'views/classes/edit.php'; // Reexibe o formulário com os erros
                return;
            }

            if ($classModel->update()) {
                header('Location: index.php?action=list_classes');
                exit();
            } else {
                echo "Erro ao atualizar a turma.";
            }
        } else {
            include 'views/classes/edit.php';
        }
    }

    public function delete($id) {
        $class = new ClassModel();
        $class->id = $id;

        if ($class->delete()) {
            header('Location: index.php?action=list_classes');
        } else {
            echo "Erro ao excluir a turma.";
        }
    }

    // Método de validação dos dados da turma
    private function validateClassData($class) {
        $errors = [];

        // Valida se o nome tem pelo menos 3 caracteres
        if (strlen($class->name) < 3) {
            $errors[] = "O nome da turma deve ter pelo menos 3 caracteres.";
        }

        // Valida se todos os campos obrigatórios foram preenchidos
        if (empty($class->name) || empty($class->description) || empty($class->type)) {
            $errors[] = "Todos os campos são obrigatórios.";
        }

        return $errors;
    }
}
