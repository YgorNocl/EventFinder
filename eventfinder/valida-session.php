<?php
session_start();

// Verifica se a variável de sessão 'usuario_logado' está definida e é verdadeira
if (!isset($_SESSION['usuario_logado']) || $_SESSION['usuario_logado'] !== true) {
    // Redireciona o usuário para a página de login ou exibe uma mensagem de erro
    echo "<script language= 'javascript' type='text/javascript'>
        alert('Acesso negado!')
        window.location.href='../formLogin.php'</script>";
    exit();
}
?>