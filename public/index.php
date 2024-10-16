<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gerenciamento</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<?php if (isset($_GET['message']) && $_GET['message'] === 'logout_success'): ?>
    <div class="alert alert-success text-center" role="alert">
        Você saiu do sistema com sucesso!
    </div>
<?php endif; ?>

</body>
</html>
<?php
    session_start();
    require_once 'routes.php';
?>
