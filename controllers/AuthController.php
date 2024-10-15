<?php
require_once 'models/User.php';

class AuthController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $userModel = new User();
            $user = $userModel->findByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                // Usuário autenticado, cria a sessão
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                // Redireciona para a lista de students
                header('Location: index.php?action=list_students');
                exit();
            } else {
                $error = "Usuário ou senha inválidos.";
                include 'views/auth/login.php'; // Recarrega a view com o erro
            }
        } else {
            include 'views/auth/login.php'; // Exibe o formulário de login
        }
    }

    public function logout() {
        session_start();
        session_destroy(); // Encerra a sessão
        header('Location: index.php?action=login');
        exit();
    }
}
