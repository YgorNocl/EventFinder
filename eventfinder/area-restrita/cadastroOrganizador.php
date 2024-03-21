<?php
 
require_once("../Classes/Organizador.php");
 
// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Cria uma instância do Organizador
    $organizador = new Organizador();
    $organizador->setNomeOrganizador($_POST["nome"]);
    $organizador->setDocOrganizador($_POST["documento"]);
    $organizador->setDataNasc($_POST["dataNascimento"]);
    $organizador->setSexoOrganizador($_POST["sexo"]);
    $organizador->setCelOrganizador($_POST["celular"]);
    $organizador->setEmailOrganizador($_POST["email"]);

    // Criptografa a senha usando bcrypt
    $senhaCriptografada = password_hash($_POST["senha"], PASSWORD_BCRYPT);
    $organizador->setSenhaOrganizador($senhaCriptografada);

    $documento = $_POST["documento"]; // Atribui o valor do documento à variável
    $celular = $_POST["celular"]; // Atribui o valor do celular à variável
    $email = $_POST["email"]; // Atribui o valor do email à variável

    if ($organizador->verificarExistenciaOrganizador($documento, $celular, $email)) {
        echo "<script language='javascript' type='text/javascript'>
            alert('Organizador já existe. Por favor, verifique os dados informados.');
            window.location.href='../formCadastroOrganizador.php';
            </script>";
        exit();
    } else {
        // Chama o método cadastrar
        $organizador->cadastrar($organizador);

        // Redireciona para uma página de sucesso ou exibe uma mensagem
        echo "<script language='javascript' type='text/javascript'>
            alert('Cadastro feito com sucesso!');
            window.location.href='../formLogin.php';
            </script>";
        exit();
    }
} else {
    echo "<script language='javascript' type='text/javascript'>
        alert('Erro ao cadastrar!');
        window.location.href='../formCadastroOrganizador.php';
        </script>";
    exit();
}

?>