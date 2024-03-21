<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/Style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
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
<?php
    require_once('../valida-session.php');
    require_once("../Classes/Evento.php");
    require_once("../Classes/Ingresso.php");
    require_once("../Classes/Usuario.php");

    // Verifique se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idEvento = $_POST['idEvento'];
        $idUsuario = $_SESSION['idUsuario'];

        $quantidade_camarote = $_POST['quantidade-camarote'];
        $quantidade_pista = $_POST['quantidade-pista'];

        if ($quantidade_camarote > 0 || $quantidade_pista > 0) {
            $evento = new Evento();
            $evento->setIdEvento($idEvento);
            $dadosEvento = $evento->buscarPorId();
            $valor_camarote = $dadosEvento['precoCamarote'] * $quantidade_camarote; 
            $valor_pista = $dadosEvento['precoPista'] * $quantidade_pista; 
            $resultado = $valor_camarote + $valor_pista;

            $ingresso = new Ingresso();
            // Verificar se o usuário já possui um ingresso para o evento
            $ingressoExistente = $ingresso->verificarIngressoExistente($idEvento, $idUsuario);

            if ($ingressoExistente) {
                ?>
<div class="wrapperCL">
    <div class="login-box">
        <div class="user-box">
            <h2>Compra Existente</h2>
            <p>Você já possui um ingresso para este evento.</p>
            <p>Deseja comprar mais um ingresso?</p>

            <form action="compra-finalizada.php" method="POST">
                <div class="form-group">
                    <label for="quantidade">Camarote:</label>
                    <input type="number" name="quantidade-camarote" id="quantidade" class="form-control" min="0"
                        value="0">
                </div>
                <div class="form-group">
                    <label for="quantidade">Pista:</label>
                    <input type="number" name="quantidade-pista" id="quantidade" class="form-control" min="0" value="0">
                </div>
                <div class="button">
                <button type="submit" class="btnCI">Comprar</button>
                <input type="hidden" name="idEvento" value="<?php echo $idEvento; ?>">
                <input type="hidden" name="idUsuario" value="<?php echo $idUsuario; ?>">
                <input type="hidden" name="valorCamarote" value="<?php echo $valor_camarote; ?>">
                <input type="hidden" name="valorPista" value="<?php echo $valor_pista; ?>">
            </form>
            <form action="index-restrito-usuario.php">
                    <button type="submit" class="btnCI">Volte para o início</button>
                </form>
        </div>
        </div>
    </div>
    
    <?php
            }else {
            ?>
            <div class="wrapperLL">
    <div class="CDE">
        <img class="imgA" src="<?php echo $dadosEvento['fotoEvento']?>">
        <img class="imgB" src="<?php echo $dadosEvento['fotoEvento']?>">
    </div>
    <div class="login-boxDE">
    <div class="user-boxDE">
    <p>Detalhes da compra:</p>
    <p>Evento: <?php echo $dadosEvento['descEvento']; ?></p>
    <p>ingressos camarote: <?php echo $quantidade_camarote; ?></p>
    <p>ingressos pista: <?php echo $quantidade_pista; ?></p>
    <p class="textE">Valor Total: R$ <?php echo $resultado; ?></p>
    <div class="button">
        <form action="compra-finalizada.php" method="POST">
            <input type="hidden" name="quantidade-camarote" value="<?php echo $quantidade_camarote; ?>">
            <input type="hidden" name="quantidade-pista" value="<?php echo $quantidade_pista; ?>">
            <input type="hidden" name="idUsuario" value="<?php echo $idUsuario; ?>">
            <input type="hidden" name="resultado" value="<?php echo $resultado; ?>">
            <input type="hidden" name="idEvento" value="<?php echo $idEvento; ?>">
            <input type="hidden" name="valorCamarote" value="<?php echo $valor_camarote; ?>">
            <input type="hidden" name="valorPista" value="<?php echo $valor_pista; ?>">
            <button type="submit" class="btnCI">Confirmar Compra</button>
        </form>
        <form action="index-restrito-usuario.php">
            <button type="submit" class="btnCI">Volte para o início</button>
        </form>
    </div>
</div>
</div>
</div>


<?php
            }
        } else {
            echo "<script language='javascript' type='text/javascript'>
                  alert('Quantidade inválida de ingressos.');
                  window.location.href='index-restrito-usuario.php';
                  </script>";
        }
    } else {
        echo "<script language='javascript' type='text/javascript'>
        alert('Acesso inválido a página.');
        window.location.href='index-restrito-usuario.php';
        </script>";
    }
    ?>
<?php  require_once "footer-restrito.php";?>

</div>
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
<script>
// Função para alternar a visibilidade da senha
function togglePasswordVisibility() {
    var passwordInput = document.getElementById("password");
    var toggleIcon = document.getElementById("toggle-icon");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleIcon.classList.add("active");
    } else {
        passwordInput.type = "password";
        toggleIcon.classList.remove("active");
    }
}

// Evento de clique no ícone de toggle
var toggleIcon = document.getElementById("toggle-icon");
toggleIcon.addEventListener("click", togglePasswordVisibility);
</script>
</body>

</html>