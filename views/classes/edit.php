<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Turma</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Editar Turma</h2>
        <form method="POST">
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($classData['name']) ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Descrição:</label>
                <input type="text" class="form-control" id="description" name="description" value="<?= htmlspecialchars($classData['description']) ?>" required>
            </div>
            <div class="form-group">
                <label for="type">Tipo:</label>
                <input type="text" class="form-control" id="type" name="type" value="<?= htmlspecialchars($classData['type']) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="index.php?action=list_classes" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
