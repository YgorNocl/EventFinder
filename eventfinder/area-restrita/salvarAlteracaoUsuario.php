<?php

require_once("../Classes/Usuario.php");

// Verifica se o formulário de alteração foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se foi fornecido o parâmetro 'idEvento' no formulário
    if (isset($_POST['idUsuario'])) {
        $idUsuario = $_POST['idUsuario'];
        $usuario = new Usuario();
        $usuario->setIdUsuario($idUsuario);
         
        // Atualiza os dados do evento com base no formulário enviado
        $usuario->setNomeUsuario($_POST['nomeUsuario']);
        $usuario->setCpfUsuario($_POST['cpfUsuario']);
        $usuario->setDataNasc($_POST['dataNasc']);
        $usuario->setSexoUsuario($_POST['sexoUsuario']);
        $usuario->setCelUsuario($_POST['celUsuario']);
        $usuario->setEmailUsuario($_POST['emailUsuario']);
       
        
        // Realiza a alteração do evento
        $resultado = $usuario->alterar();

        // Verifica se a alteração foi bem-sucedida
        if ($resultado === "Dados alterados com sucesso.") {
            echo "<script language='javascript' type='text/javascript'>
                  alert('$resultado');
                  window.location.href='index-restrito-usuario.php';
                  </script>";
            exit();
        } else {
            echo "<script language='javascript' type='text/javascript'>
                  alert('Erro ao alterar os dados: $resultado');
                  window.location.href='index-restrito-usuario.php';
                  </script>";
            exit();
        }
    }
} else {
    // Redireciona para a página principal (evento.php) se o formulário não foi enviado
    echo "<script language='javascript' type='text/javascript'>
    alert('Erro ao pegar os dados do formulário: $resultado');
    window.location.href='index-restrito-usuario.php';
    </script>";
    exit();
}
?>