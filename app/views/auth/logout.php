<?php
session_start();
session_destroy(); // Encerra a sessão do usuário
header('Refresh: 2; url=public/index.php'); // Redireciona para a página inicial após 2 segundos
?>

<?php include '../app/views/partials/header.php'; ?>
<div class="container text-center" style="margin-top: 50px;">
    <h1>Você saiu com sucesso!</h1>
    <p>Redirecionando para a página inicial...</p>
    <div class="spinner-border text-success" role="status">
        <span class="sr-only">Carregando...</span>
    </div>
</div>
<?php include '../app/views/partials/footer.php'; ?>
