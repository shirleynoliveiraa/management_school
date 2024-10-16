<?php
require_once '../app/models/Class.php';

class ClassController {
    public function list($page = 1) {
        $classModel = new ClassModel();
        $limit = 5;
        $offset = ($page - 1) * $limit;

        // Retrieve paginated class records
        $classes = $classModel->readAll($offset, $limit);
        $totalClasses = $classModel->count();
        $totalPages = ceil($totalClasses / $limit);

        // Render the list view with pagination data
        include '../app/views/classes/list.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $class = new ClassModel();
            $class->name = $_POST['name'];
            $class->description = $_POST['description'];
            $class->type = $_POST['type'];

            // Validate input data
            $errors = $this->validateClassData($class);

            // Attempt to create a new class record
            if ($class->create()) {
                header('Location: /public/index.php?action=list_classes');
                exit(); // Ensure no further code is executed after redirect
            } else {
                echo "Erro ao cadastrar a turma.";
            }
        } else {
            // Render the creation form
            include '../app/views/classes/create.php';
        }
    }

    public function edit($id) {
        $classModel = new ClassModel();
        $classData = $classModel->readById($id);

        if (!$classData) {
            echo "Turma não encontrada!";
            return; // Stop execution if class not found
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Populate the model with updated data
            $classModel->id = $id;
            $classModel->name = $_POST['name'];
            $classModel->description = $_POST['description'];
            $classModel->type = $_POST['type'];

            // Validate updated data
            $errors = $this->validateClassData($classModel);

            // Attempt to update the class record
            if ($classModel->update()) {
                header('Location: /public/index.php?action=list_classes');
                exit(); // Ensure no further code is executed after redirect
            } else {
                echo "Erro ao atualizar a turma.";
            }
        } else {
            // Render the edit form with the current class data
            include '../app/views/classes/edit.php';
        }
    }

    public function delete($id) {
        $class = new ClassModel();
        $class->id = $id;

        // Attempt to delete the class record
        if ($class->delete()) {
            header('Location: /public/index.php?action=list_classes');
            exit(); // Ensure no further code is executed after redirect
        } else {
            echo "Erro ao excluir a turma.";
        }
    }

    // Validate class data to ensure consistency and required fields
    private function validateClassData($class) {
        $errors = [];

        // Ensure the name is at least 3 characters long
        if (strlen($class->name) < 3) {
            $errors[] = "O nome da turma deve ter pelo menos 3 caracteres.";
        }

        // Check that all required fields are filled
        if (empty($class->name) || empty($class->description) || empty($class->type)) {
            $errors[] = "Todos os campos são obrigatórios.";
        }

        return $errors;
    }
}
