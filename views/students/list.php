<?php
include 'views/header.php';

  if (isset($_SESSION['error_message'])) {
      echo "<div class='alert alert-danger'>{$_SESSION['error_message']}</div>";
      unset($_SESSION['error_message']);
  }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Alunos</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        h2 {
            margin-bottom: 20px;
        }
        .list-group-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Lista de Alunos</h2>
        <a href="index.php?action=create" class="btn btn-success mb-3">Cadastrar Novo Aluno</a>
        <ul class="list-group">
            <?php while ($row = $students->fetch(PDO::FETCH_ASSOC)): ?>
                <li class="list-group-item">
                    <span><?= htmlspecialchars($row['name']) ?></span>
                    <span>
                        <a href="index.php?action=edit&id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="index.php?action=delete&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>
                    </span>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
</body>
</html>
