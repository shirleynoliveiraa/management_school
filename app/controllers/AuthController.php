<?php
require_once '../config/database.php'; // Import Database class

class AuthController {
    private $pdo;

    public function __construct() {
        // Initialize database connection using the Database class
        $database = new Database();
        $this->pdo = $database->getConnection();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Query the database for the user with the provided username
            $stmt = $this->pdo->prepare('SELECT * FROM users WHERE username = :username');
            $stmt->execute(['username' => $username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verify if the user exists and the password matches
            if ($user && password_verify($password, $user['password'])) {
                session_start(); // Ensure session is started
                $_SESSION['user'] = $user['username']; // Store username in session

                // Redirect to the home page upon successful login
                header('Location: /public/index.php');
                exit;
            } else {
                // Display error message for invalid credentials
                echo "<div class='alert alert-danger'>Login ou senha inválidos.</div>";
            }
        }

        // Render the login form
        $this->renderLoginForm();
    }

    public function logout() {
        // Ensure session is started before attempting to destroy it
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_destroy(); // Destroy the session

        // Redirect to the home page after logging out
        header('Location: /public/index.php?message=logout_success');
        exit;
    }

    // Helper method to render the login form
    private function renderLoginForm() {
        echo '
        <form method="POST" action="/public/index.php?action=login">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Senha" required>
            <button type="submit">Login</button>
        </form>';
    }
}
