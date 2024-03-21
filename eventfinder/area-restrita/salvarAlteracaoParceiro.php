<?php

require_once("../Classes/Parceiro.php");

// Verifica se o formulário de alteração foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se foi fornecido o parâmetro 'idEvento' no formulário
    if (isset($_POST['idParceiro'])) {
        $idParceiro = $_POST['idParceiro'];
        $parceiro = new Parceiro();
        $parceiro->setIdParceiro($idParceiro);
         
        // Atualiza os dados do evento com base no formulário enviado
        $parceiro->setNomeParceiro($_POST['nomeParceiro']);
        $parceiro->setCnpjParceiro($_POST['cnpjParceiro']);
        $parceiro->setCelParceiro($_POST['celParceiro']);
        $parceiro->setEmailParceiro($_POST['emailParceiro']);
        $parceiro->setCep($_POST['cep']);
        $parceiro->setLogradouro($_POST['logradouro']);
        $parceiro->setNumero($_POST['numero']);
        $parceiro->setBairro($_POST['bairro']);
        $parceiro->setCidade($_POST['cidade']);
        $parceiro->setEstado($_POST['estado']);
       
        
        // Realiza a alteração do evento
        $resultado = $parceiro->alterar();

        // Verifica se a alteração foi bem-sucedida
        if ($resultado === "Dados alterados com sucesso.") {
            echo "<script language='javascript' type='text/javascript'>
                  alert('$resultado');
                  window.location.href='index-restrito-parceiro.php';
                  </script>";
            exit();
        } else {
            echo "<script language='javascript' type='text/javascript'>
                  alert('Erro ao alterar os dados: $resultado');
                  window.location.href='index-restrito-parceiro.php';
                  </script>";
            exit();
        }
    }
} else {
    // Redireciona para a página principal (evento.php) se o formulário não foi enviado
    echo "<script language='javascript' type='text/javascript'>
    alert('Erro ao pegar os dados do formulário: $resultado');
    window.location.href='index-restrito-parceiro.php';
    </script>";
    exit();
}
?>