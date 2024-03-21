<?php

require_once("../Classes/Organizador.php");

// Verifica se o formulário de alteração foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se foi fornecido o parâmetro 'idEvento' no formulário
    if (isset($_POST['idOrganizador'])) {
        $idOrganizador = $_POST['idOrganizador'];
        $organizador = new Organizador();
        $organizador->setIdOrganizador($idOrganizador);
         
        // Atualiza os dados do evento com base no formulário enviado
        $organizador->setNomeOrganizador($_POST['nomeOrganizador']);
        $organizador->setDocOrganizador($_POST['docOrganizador']);
        $organizador->setDataNasc($_POST['dataNasc']);
        $organizador->setSexoOrganizador($_POST['sexoOrganizador']);
        $organizador->setCelOrganizador($_POST['celOrganizador']);
        $organizador->setEmailOrganizador($_POST['emailOrganizador']);
       
         
        // Realiza a alteração do evento
        $resultado = $organizador->alterar();

        // Verifica se a alteração foi bem-sucedida
        if ($resultado === "Dados alterados com sucesso.") {
            echo "<script language='javascript' type='text/javascript'>
                  alert('$resultado');
                  window.location.href='index-restrito-organizador.php';
                  </script>";
            exit();
        } else {
            echo "<script language='javascript' type='text/javascript'>
                  alert('Erro ao alterar os dados: $resultado');
                  window.location.href='index-restrito-organizador.php';
                  </script>";
            exit();
        }
    }
} else {
    // Redireciona para a página principal (evento.php) se o formulário não foi enviado
    echo "<script language='javascript' type='text/javascript'>
    alert('Erro ao pegar os dados do formulário: $resultado');
    window.location.href='index-restrito-organizador.php';
    </script>";
    exit();
}
?>