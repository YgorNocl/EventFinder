<?php
// Inclui o arquivo de validação da sessão
require_once('../valida-session.php');?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/Style.css">
    <title>PÁGINA Organizador</title>
</head>

<body>
    <header>

        <nav>
            <a class="logo" href="index-restrito-parceiro.php"><img src="images/logo/logo.png" class="logo-img"></a>
            <form class="form-inline my-2 my-lg-0" method="POST" action="resultados-pesquisa-parceiro.php">
                <input class="caixa" type="search" placeholder="Search" aria-label="Search" name="pesquisa">
                <button class="btn" type="submit">Search</button>
            </form>
            <ul class="nav">
                <a class="at" href="../logout.php">Sair</a>
            </ul>

            </div>
        </nav>
    </header>


    <?php
require_once("../Classes/Evento.php");
if (isset($_POST['pesquisa'])) {
    $termoPesquisa = $_POST['pesquisa'];
    $evento = new Evento();
    $resultados = $evento->pesquisarEventos($termoPesquisa);
?>
    <?php foreach ($resultados as $resultado) { ?>
    <div class="container">
        <div class="card" style="width: 18rem;">
            <img src="<?php echo $resultado['fotoEvento'] ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?php echo $resultado['descEvento'] ?></h5>
                <p class="card-text">Tipo: <?php echo $resultado['tipoEvento'] ?></p>
                <p class="card-text">Local: <?php echo $resultado['localEvento'] ?></p>
                <form method="" action="formLogin.php">
                    <input type="hidden" name="idEvento" value="<?php echo $resultado['idEvento']; ?>">
                    <button type="submit" class="btn btn-primary">Clique para mais informações</button>
                </form>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php } ?>
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