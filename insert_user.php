<?php
// Conexão com o banco de dados
$host = '127.0.0.1:3307';
$dbname = 'school_management';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Dados do usuário a ser inserido
    $username = 'admin@admin.com';
    $plainPassword = 'admin';
    $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

    // SQL para inserir o usuário
    $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashedPassword);

    // Executa o insert
    if ($stmt->execute()) {
        echo "Usuário inserido com sucesso!";
    } else {
        echo "Erro ao inserir o usuário.";
    }
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}
