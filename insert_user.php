<?php
// connecting to the database
$host = '127.0.0.1:3307';
$dbname = 'school_management';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // User to be inserted 
    $username = 'admin@admin.com';
    $plainPassword = 'admin';
    $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

    // SQL to insert user
    $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashedPassword);

    // Insert the user
    if ($stmt->execute()) {
        echo "Usuário inserido com sucesso!";
    } else {
        echo "Erro ao inserir o usuário.";
    }
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}
