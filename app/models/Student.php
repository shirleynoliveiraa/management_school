<?php
require_once __DIR__ . '/../../config/database.php';

class Student {
    private $conn;
    private $table = "students";

    public $id;
    public $name;
    public $birth_date;
    public $username;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " (name, birth_date, username) VALUES (:name, :birth_date, :username)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':birth_date', $this->birth_date);
        $stmt->bindParam(':username', $this->username);

        try {
          return $stmt->execute();
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                return "O username já está em uso. Por favor, escolha outro.";
            } else {
                return "Erro ao cadastrar aluno: " . $e->getMessage();
            }
        }
    }

    public function readAll() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY name ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function readById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update() {
        $query = "UPDATE " . $this->table . " SET name = :name, birth_date = :birth_date, username = :username WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':birth_date', $this->birth_date);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }
}
