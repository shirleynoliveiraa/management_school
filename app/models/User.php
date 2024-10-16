<?php
require_once __DIR__ . '/../../config/database.php';

class User {
    private $db;

    private $conn;

    public function __construct() {
      $database = new Database();
      $this->conn = $database->getConnection();
  }

    // Método para criar um novo usuário
    public function create($username, $password) {
        $stmt = $this->db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        return $stmt->execute(['username' => $username, 'password' => $password]);
    }

    // Método para buscar um usuário pelo username
    public function findByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
