<?php
require_once '../app/controllers/StudentController.php';
require_once '../app/controllers/ClassController.php';
require_once '../app/controllers/EnrollmentController.php';
require_once '../app/controllers/AuthController.php';

$studentController = new StudentController();
$classController = new ClassController();
$enrollmentController = new EnrollmentController();
$authController = new AuthController();

$action = $_GET['action'] ?? 'home';
$id = $_GET['id'] ?? null;

$protectedRoutes = [
    'list', 'create', 'edit', 'delete',
    'list_classes', 'create_class', 'edit_class', 'delete_class',
    'enroll', 'list_enrollments'
];

if (in_array($action, $protectedRoutes) && !isset($_SESSION['user'])) {
    header('Location: /public/index.php?action=login');
    exit;
}

switch ($action) {
    case 'login':
        $authController->login();
        break;
    case 'logout':
        $authController->logout();
        break;
    case 'list':
        $studentController->list();
        break;
    case 'create':
        $studentController->create();
        break;
    case 'edit':
        if ($id) $studentController->edit($id);
        break;
    case 'delete':
        if ($id) $studentController->delete($id);
        break;
    case 'list_classes':
        $page = $_GET['page'] ?? 1;
        $classController->list($page);
        break;
    case 'create_class':
        $classController->create();
        break;
    case 'edit_class':
        if ($id) $classController->edit($id);
        break;
    case 'delete_class':
        if ($id) $classController->delete($id);
        break;
    case 'enroll':
        $enrollmentController->enroll();
        break;
    case 'list_enrollments':
        $enrollmentController->list();
        break;
    default:
        include '../app/views/partials/home.php';
        break;
}
