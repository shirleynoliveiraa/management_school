<?php include '../app/views/partials/header.php'; ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matricular Aluno</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Matricular Aluno</h2>

        <?php if (isset($errorMessage)): ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($errorMessage) ?>
            </div>
            <a href="/public/index.php?action=list_enrollments" class="btn btn-secondary">Voltar para Lista de Matrículas</a>
        <?php else: ?>
            <form method="POST">
                <div class="form-group">
                    <label for="student_id">Aluno:</label>
                    <select name="student_id" id="student_id" class="form-control" required>
                        <?php foreach ($students as $student): ?>
                            <option value="<?= $student['id'] ?>"><?= htmlspecialchars($student['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="class_id">Turma:</label>
                    <select name="class_id" id="class_id" class="form-control" required>
                        <?php foreach ($classes as $class): ?>
                            <option value="<?= $class['id'] ?>"><?= htmlspecialchars($class['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Matricular</button>
                <a href="/public/index.php?action=list_enrollments" class="btn btn-secondary">Cancelar</a>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
