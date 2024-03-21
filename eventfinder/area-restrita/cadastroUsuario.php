<?php

require_once("../Classes/Usuario.php");

// Verifica se os dados foram enviados via método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Cria uma instância da classe Usuario
    $usuario = new Usuario();

    // Define os valores dos atributos com base nos dados recebidos do formulário
    $usuario->setNomeUsuario($_POST["nomeUsuario"]);
    $usuario->setCpfUsuario($_POST["cpfUsuario"]);
    $usuario->setDataNasc($_POST["dataNasc"]);
    $usuario->setSexoUsuario($_POST["sexoUsuario"]);
    $usuario->setCelUsuario($_POST["celUsuario"]);
    $usuario->setEmailUsuario($_POST["emailUsuario"]);

    // Criptografa a senha usando bcrypt
    $senhaCriptografada = password_hash($_POST["senhaUsuario"], PASSWORD_BCRYPT);
    $usuario->setSenhaUsuario($senhaCriptografada);

    // Verifica se o usuário já existe no banco de dados
    $cpf = $_POST["cpfUsuario"];
    $celular = $_POST["celUsuario"];
    $email = $_POST["emailUsuario"];

    if ($usuario->verificarExistenciaUsuario($cpf, $celular, $email)) {
        echo "<script language= 'javascript' type='text/javascript'>
            alert('Usuário já existe. Por favor, verifique os dados informados.')
            window.location.href='../formCadastroUsuario.php'</script>";
        exit();
    }

    // Chama o método cadastrar para inserir os dados do usuário no banco de dados
    $usuario->cadastrar($usuario);

    // Redireciona para uma página de sucesso ou exibe uma mensagem de sucesso

    echo "<script language= 'javascript' type='text/javascript'>
        alert('Cadastro feito com sucesso!')
        window.location.href='../formLogin.php'</script>";
    exit();
} else {
    echo "<script language= 'javascript' type='text/javascript'>
        alert('Erro ao cadastrar!')
        window.location.href='../formCadastroUsuario.php'</script>";
    exit();
}

?>