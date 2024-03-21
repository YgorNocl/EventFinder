<?php

require_once("../Classes/Parceiro.php");

// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $nomeParceiro = $_POST["nomeParceiro"];
    $cnpjParceiro = $_POST["cnpjParceiro"];
    $celParceiro = $_POST["celParceiro"];
    $emailParceiro = $_POST["emailParceiro"];
    $senhaParceiro = $_POST["senhaParceiro"];
    $logradouro = $_POST["logradouro"];
    $numero = $_POST["numero"];
    $bairro = $_POST["bairro"];
    $cidade = $_POST["cidade"];
    $estado = $_POST["estado"];
    $cep = $_POST["cep"];
  
    // Criptografa a senha usando bcrypt
    $senhaCriptografada = password_hash($senhaParceiro, PASSWORD_BCRYPT);

    // Cria uma instância do Parceiro
    $parceiro = new Parceiro();
    $parceiro->setNomeParceiro($nomeParceiro);
    $parceiro->setCnpjParceiro($cnpjParceiro);
    $parceiro->setCelParceiro($celParceiro);
    $parceiro->setEmailParceiro($emailParceiro);
    $parceiro->setSenhaParceiro($senhaCriptografada);
    $parceiro->setLogradouro($logradouro);
    $parceiro->setNumero($numero);
    $parceiro->setBairro($bairro);
    $parceiro->setCidade($cidade);
    $parceiro->setEstado($estado);
    $parceiro->setCep($cep);

    // Chama o método cadastrar
    $parceiro->cadastrar($parceiro);

    // Redireciona para uma página de sucesso ou exibe uma mensagem
    
    echo "<script language= 'javascript' type='text/javascript'>
        alert('Cadastro feito com sucesso!')
        window.location.href='../formLogin.php'</script>";
    exit();
}else{
    echo "<script language= 'javascript' type='text/javascript'>
    alert('Erro ao cadastrar!')
    window.location.href='../formCadastroParceiro.php'</script>";
    exit();
}

?>