<?php
require_once('../valida-session.php');
require_once('../Classes/Parceiro.php');

// Cria uma instância da classe Organizador
$parceiro= new Parceiro();

// Recupera o ID do organizador da variável de sessão
$idParceiro = $_SESSION['idParceiro'];


// Busca os dados completos do organizador
$dadosParceiro= $parceiro->buscaParceiroPorId($idParceiro);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">


    <title>PÁGINA INICIAL PARCEIRO</title>
</head>

<body>
    <header>
            <nav class="nav-bar">
                <a class="logo" href="index-restrito-organizador.php"><img src="images/logo/logo.png" class="logo-img"></a>
                <form class="form_inline" method="POST" action="resultados-pesquisa-parceiro.php">
                    <input class="caixa" type="search" placeholder="Search" aria-label="Search" name="pesquisa">
                    <button class="btn" type="submit">Search</button>
                    </form>
                </div>
                <div class="nav-list">
                    <ul>
                        <li class="nav-item"><a href="formCadastrarEventoOrganizador.php" class="nav-link">Eventos</a></li>
                        <li class="nav-item"><a href="perfilOrganizador.php" class="nav-link">Perfil</a></li>
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
                    <li class="nav-item"><a href="../logout.php" class="nav-link">Sair</a></li>
                </ul>
            </div>
    </header>


    <div class="box">
        <div class="ec">
            <h2>Olá, <?php echo $dadosParceiro['nomeParceiro']; ?></h2>
            <p><strong>CNPJ:</strong> <?php echo $dadosParceiro['cnpjParceiro']; ?></p>
            <p><strong>Celular::</strong> <?php echo $dadosParceiro['celParceiro']; ?></p>
            <p><strong>Email:</strong> <?php echo $dadosParceiro['emailParceiro']; ?></p>
            <p><strong>CEP:</strong> <?php echo $dadosParceiro['cep']; ?></p>
            <form method="GET" action="alterarParceiro.php">
                <input type="hidden" name="idParceiro" value="<?php echo $idParceiro; ?>">
                <button type="submit" class="btn2">Alterar Dados</button>
            </form>
        </div>
    </div>
    </div>
    </div>
    <div class="wrapperCC">
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