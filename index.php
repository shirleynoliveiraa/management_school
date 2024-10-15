<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Alunos e Turmas</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Sistema de Alunos e Turmas</h1>

        <nav>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Início</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=list">Lista de Alunos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=list_classes">Lista de Turmas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=list_enrollments">Lista de Matrículas</a>
                </li>
            </ul>
        </nav>

        <?php
        session_start(); // Inicia a sessão

        require_once 'controllers/StudentController.php';
        require_once 'controllers/ClassController.php';
        require_once 'controllers/EnrollmentController.php';
        require_once 'controllers/AuthController.php'; // Inclui o AuthController

        $studentController = new StudentController();
        $classController = new ClassController();
        $enrollmentController = new EnrollmentController();
        $authController = new AuthController(); // Instancia o AuthController

        $action = $_GET['action'] ?? 'home'; 
        $id = $_GET['id'] ?? null;

        // Ações de autenticação
        if ($action === 'login') {
            $authController->login(); // Exibe o formulário de login
        } elseif ($action === 'logout') {
            $authController->logout(); // Realiza o logout
        } 
        // Ações para alunos
        elseif ($action === 'list') {
            $studentController->list();
        } elseif ($action === 'create') {
            $studentController->create();
        } elseif ($action === 'edit' && $id) {
            $studentController->edit($id);
        } elseif ($action === 'delete' && $id) {
            $studentController->delete($id);
        } 
        // Ações para turmas
        elseif ($action === 'list_classes') {
            $page = $_GET['page'] ?? 1;
            $classController->list($page);
        } elseif ($action === 'create_class') {
            $classController->create();
        } elseif ($action === 'edit_class' && $id) {
            $classController->edit($id);
        } elseif ($action === 'delete_class' && $id) {
            $classController->delete($id);
        } 
        // Ações para matrícula
        elseif ($action === 'enroll') {
            $enrollmentController->enroll();
        } elseif ($action === 'list_enrollments') {
            $enrollmentController->list();
        } 
        // Ação padrão
        else {
            echo "<h2>Bem-vindo ao Sistema de Alunos e Turmas</h2>";
        }
        ?>
    </div>
</body>
</html>
