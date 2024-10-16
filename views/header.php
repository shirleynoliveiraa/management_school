<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Alunos e Turmas</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #f0f2f5; font-family: 'Arial', sans-serif; }
        .navbar { margin-bottom: 20px; background-color: #4CAF50; }
        .navbar-brand { font-weight: bold; font-size: 1.5rem; color: #fff !important; }
        .nav-link { color: #fff !important; }
        .nav-link:hover { text-decoration: underline; }
        .container h1 { text-align: center; margin-top: 20px; margin-bottom: 40px; color: #333; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="index.php">
            <i class="fas fa-graduation-cap"></i> School Manager
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="index.php"><i class="fas fa-home"></i> Início</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?action=list"><i class="fas fa-users"></i> Lista de Alunos</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?action=list_classes"><i class="fas fa-chalkboard"></i> Lista de Turmas</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?action=list_enrollments"><i class="fas fa-user-plus"></i> Matrículas</a></li>
                <?php if (isset($_SESSION['user'])): ?>
                    <li class="nav-item"><a class="nav-link" href="index.php?action=logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="index.php?action=login"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
