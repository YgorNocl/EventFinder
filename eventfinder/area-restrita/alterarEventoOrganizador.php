<?php
  // Inclui o arquivo de validação da sessão
  require_once('../valida-session.php');
  require_once('../Classes/Evento.php');
  ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/Style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <title>PÁGINA INICIAL RESTRITA ORGANIZADOR</title>

</head>

<body>
<div class="wrapperLLL">
        <header>
            <nav>
                <a class="logo" href="index-restrito-organizador.php"><img src="images/logo/logo.png"
                        class="logo-img"></a>
                <form class="form-inline my-2 my-lg-0" method="POST" action="resultados-pesquisa-organizador.php">
                    <input class="caixa" type="search" placeholder="Search" aria-label="Search" name="pesquisa">
                    <button class="btn" type="submit">Search</button>
                </form>
                <ul class="nav">
                    <a class="at" href="formCadastrarEventoOrganizador.php">Eventos</a>
                    <a class="at" href="perfilOrganizador.php">Perfil</a>
                    <a class="at" href="../logout.php">Sair</a>
                </ul>

    </div>
    </nav>
    </header>
    <?php 
 
 require_once("../Classes/Evento.php");
 
 if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["idEvento"])) {
     $idEvento = $_GET["idEvento"];
 
     // Buscar os dados do cliente no banco de dados usando o ID
     $evento = new Evento();
     $evento->setIdEvento($idEvento);
 
     // Obter os dados do cliente a partir do ID
     $dadosEvento = $evento->buscarPorId();
 
     // Verificar se o cliente foi encontrado
     if ($dadosEvento) {
         // Preencher os campos do formulário com os dados do cliente
         $descEvento = $dadosEvento["descEvento"];
         $tipoEvento = $dadosEvento["tipoEvento"];
         $idadeMinima = $dadosEvento["idadeMinima"];
         $precoCamarote = $dadosEvento["precoCamarote"];
         $precoPista = $dadosEvento["precoPista"];
         $localEvento = $dadosEvento["localEvento"];
         $dataEvento = $dadosEvento["dataEvento"];
         $horaEvento = $dadosEvento["horaEvento"];
         $horaAbertura = $dadosEvento["horaAberturaEvento"];
     } else {
         
      
         exit();
     }
 }
 
 ?>
    <div class="login-boxCO">
            <h2>Alteração de Evento</h2>
            <form method="post" action="salvarAlteracaoEvento.php" enctype="multipart/form-data">

                <label>Descrição Evento:</label>
                <input required class="caixa" type="text" name="descEvento" required value="<?php echo $descEvento ?? ''; ?>"><br><br>

                <label>Tipo de Evento:</label>
                <input required class="caixa" type="text" name="tipoEvento" required value="<?php echo $tipoEvento ?? ''; ?>"><br><br>

                <label>Foto do Evento:</label>
                <input type="file" required name="fotoEvento" required><br><br>

                <label>Idade Miníma:</label>
                <input type="number" required class="caixa" name="idadeMinima" required value="<?php echo $idadeMinima ?? ''; ?>"><br><br>

                <label>Preço Camarote:</label>
                <input required type="number" class="caixa" name="precoCamarote"  required value="<?php echo $precoCamarote ?? ''; ?>"><br><br>

                <label>Preço Pista:</label>
                <input required type="number" class="caixa" name="precoPista" required value="<?php echo $precoPista ?? ''; ?>"><br><br>

                <label>Local do Evento:</label>
                <input required type="text" class="caixa" name="localEvento" required value="<?php echo $localEvento ?? ''; ?>"><br><br>

                <label>Data do Evento:</label>
                <input required type="date" class="caixa" name="dataEvento" required value="<?php echo $dataEvento ?? ''; ?>"><br><br>

                <label>Hora do Evento:</label>
                <input required type="time" class="caixa" name="horaEvento" required value="<?php echo $horaEvento ?? ''; ?>"><br><br>

                <label>Hora de Abertura do Evento:</label>
                <input required type="time" class="caixa" name="horaAberturaEvento" required value="<?php echo $horaAbertura ?? ''; ?>"><br><br>
                <?php  $idOrganizador = $_SESSION['idOrganizador']; ?>
                <input type="hidden" name="idEvento" value="<?php echo $idEvento; ?>">
                <button type="submit" class="btnCI">Alterar</button>
            </form>
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


 
 
 
     