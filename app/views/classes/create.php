<?php include '../app/views/partials/header.php'; ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Nova Turma</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Cadastrar Nova Turma</h2>
        <form action="/public/index.php?action=create_class" method="POST">
            <div class="form-group">
                <label for="name">Nome da Turma:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">Descrição:</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="type">Tipo:</label>
                <input type="text" class="form-control" id="type" name="type" required>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
            <a href="/public/index.php?action=list_classes" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
