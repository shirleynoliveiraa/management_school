<?php
require_once 'config/database.php';

class Enrollment {
    private $conn;
    private $table = "enrollments";

    public $id;
    public $student_id;
    public $class_id;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " (student_id, class_id) VALUES (:student_id, :class_id)";
        $stmt = $this->conn->prepare($query);

        // Verifica se já existe uma matrícula
        $stmt->bindParam(':student_id', $this->student_id);
        $stmt->bindParam(':class_id', $this->class_id);

        // Tenta executar a inserção
        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            // Se já existir matrícula, retorna false
            if ($e->getCode() == 23000) { // Código de erro para violação de chave única
                return false; 
            }
            throw $e; // Re-throw se não for um erro de duplicata
        }
    }

    public function readAll() {
        $query = "SELECT enrollments.*, students.name AS student_name, classes.name AS class_name 
                  FROM " . $this->table . "
                  JOIN students ON enrollments.student_id = students.id
                  JOIN classes ON enrollments.class_id = classes.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readStudentsInClass($class_id) {
        $query = "SELECT students.* FROM " . $this->table . " 
                  JOIN students ON enrollments.student_id = students.id 
                  WHERE class_id = :class_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':class_id', $class_id);
        $stmt->execute();
        return $stmt;
    }
}
