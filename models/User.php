<?php

class User {
    private $db;

    public function __construct() {
        // Configuração básica de conexão com MySQL
        $this->db = new PDO('mysql:host=localhost;dbname=seu_banco', 'seu_usuario', 'sua_senha');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
