<?php

require_once("../Classes/Evento.php");
require_once("../Classes/Ingresso.php");
require_once('../valida-session.php');


// Verifique se o ID do evento foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idEvento'])) {
    $idEvento = $_POST['idEvento'];
    $quantidade_camarote = $_POST['quantidade-camarote'];
    $quantidade_pista = $_POST['quantidade-pista'];
    $valorCamarote = $_POST['valorCamarote'] ;
    $valorPista = $_POST['valorPista'];
    $resultado = $valorCamarote + $valorPista;
    $idUsuario = $_SESSION['idUsuario'];
       // Cadastrar o ingresso 
       $ingresso = new Ingresso();
       $ingresso->setIdEvento($idEvento);
       $ingresso->setQuantidadeCamarote($quantidade_camarote);
       $ingresso->setQuantidadePista($quantidade_pista);
       $ingresso->setValorCamarote($valorCamarote);
       $ingresso->setValorPista($valorPista);
       $ingresso->setValorTotal($resultado);
       $ingresso->setDataCompra(date("Y-m-d"));
       $ingresso->setIdUsuario($idUsuario); // Define o ID do usuário

       $ingresso->cadastrarIngresso($ingresso);
     
    $evento = new Evento();
    $evento->setIdEvento($idEvento);
    $dadosEvento = $evento->buscarPorId();

    // Exibir informações do ingresso
    
   
    $dadosIngresso = $ingresso->buscarIngressoPorIdUsuario($idUsuario);


// ...

$dadosIngresso = $ingresso->buscarIngressoEvento($idUsuario, $idEvento);

if ($dadosIngresso) {
    ?>
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/Style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
</head>
<header>
            <nav class="nav-bar">
                <a class="logo" href="index-restrito-usuario.php"><img src="images/logo/logo.png" class="logo-img"></a>
                <form class="form_inline" method="POST" action="resultados-pesquisa.php">
                    <input class="caixa" type="search" placeholder="Search" aria-label="Search" name="pesquisa">
                    <button class="btn" type="submit">Search</button>
                    </form>
                </div>
                <div class="nav-list">
                    <ul>
                        <li class="nav-item"><a href="historico-pedidos.php" class="nav-link">Histórico</a></li>
                        <li class="nav-item"><a href="perfilUsuario.php" class="nav-link">Perfil</a></li>
                        <li class="nav-item"><a href="../logout.php" class="nav-link">Sair</a></li>
                    </ul>
                </div>
                <div class="mobile-menu-icon">
                    <button onclick="menuShow()"><img class="icon" src="images/nav/open.svg" alt=""></button>
                </div>
            </nav>
            <div class="mobile-menu">
                <ul>
                    <form class="form_inline" method="POST" action="resultados-pesquisa.php">
                    <input class="caixa2" type="search" placeholder="Search" aria-label="Search" name="pesquisa">
                    </form>
                    <li class="nav-item"><a href="historico-pedidos.php" class="nav-link">Histórico</a></li>
                    <li class="nav-item"><a href="perfilUsuario.php" class="nav-link">Perfil</a></li>
                    <li class="nav-item"><a href="../logout.php" class="nav-link">Sair</a></li>
                </ul>
            </div>
    </header>
    <div class="wrapperCC">
    <div class="login-box">
        <div class="user-box">
<h2>Compra Finalizada</h2>
<h3>Detalhes do Ingresso</h3>
<p><strong>Data da Compra:</strong> <?php echo $dadosIngresso['dataCompra']; ?></p>
<p><strong>Quantidade de Ingressos - Camarote:</strong> <?php echo $dadosIngresso['quantidadeCamarote']; ?></p>
<p><strong>Quantidade de Ingressos - Pista:</strong> <?php echo $dadosIngresso['quantidadePista']; ?></p>
<p><strong>Valor Total:</strong> <?php echo $dadosIngresso['valorTotal']; ?></p>

<p>Seu pedido foi finalizado com sucesso, vamos enviar um email pra você com a chave pix para pagamento,<br> e assim que
    o pagamento for confirmado, o prazo para o ingresso ser gerado é 3 dias úteis!</p>
<?php
} else {
    echo "<p>Não foi possível encontrar os detalhes do ingresso.</p>";
}

// ...

} else {
    echo "<p>O ID do evento não foi enviado corretamente.</p>";
}
?>
        </div>
    </div>
    </div>
<?php require_once("./footer-restrito.php")?>
    <!--libras-->
    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
    new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>

    <!--end libras-->
</body>

</html>