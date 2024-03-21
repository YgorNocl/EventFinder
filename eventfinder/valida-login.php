<?php

session_start();

require_once("./Classes/Usuario.php");
require_once("./Classes/Parceiro.php");
require_once("./Classes/Organizador.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $usuario = new Usuario();
    $parceiro = new Parceiro();
    $organizador = new Organizador();
    $dashboardUrl = null;

    // Verificar na tabela tbUsuario
    $usuarioDashboard = $usuario->validarLogin($email, $senha);
    if ($usuarioDashboard) {
        $dashboardUrl = $usuarioDashboard;
        $_SESSION['idUsuario'] = $usuario->getIdUsuarioByEmail($email);
    }
 
    // Verificar na tabela tbParceiro
    $parceiroDashboard = $parceiro->validarLogin($email, $senha);
    if ($parceiroDashboard) {
        $dashboardUrl = $parceiroDashboard;
        $_SESSION['idParceiro'] = $parceiro->getIdParceiroByEmail($email);
    }

    // Verificar na tabela tbOrganizador
    $organizadorDashboard = $organizador->validarLogin($email, $senha);
    if ($organizadorDashboard) {
        $dashboardUrl = $organizadorDashboard;
        $_SESSION['idOrganizador'] = $organizador->getIdOrganizadorByEmail($email);
    }

    if ($dashboardUrl) {
        $_SESSION["usuario_logado"] = true;
        echo "<script language='javascript' type='text/javascript'>
        alert('Logado com sucesso!')
        window.location.href='$dashboardUrl'</script>";
        exit();
    } else {
        echo "<script language='javascript' type='text/javascript'>
        alert('Erro ao entrar, credenciais incorretas!')
        window.location.href='formLogin.php'</script>";
    }
}
?>