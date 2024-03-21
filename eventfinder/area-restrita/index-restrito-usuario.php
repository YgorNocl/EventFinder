<?php
// Inclui o arquivo de validação da sessão
require_once('../valida-session.php');

require_once('../Classes/Usuario.php');

// Cria uma instância da classe Organizador
$usuario= new Usuario();

// Recupera o ID do organizador da variável de sessão
$idUsuario = $_SESSION['idUsuario'];

// Busca os dados completos do organizador
$dadosUsuario= $usuario->buscarUsuarioPorId($idUsuario);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <title>PÁGINA EVENTOS</title>
</head>
 
<body>
    <header>
            <nav class="nav-bar">
                <a class="logo" href="index-restrito-usuario.php"><img src="images/logo/logo.png" class="logo-img"></a>
                <form class="form_inline" method="POST" action="resultados-pesquisa-restrito-usuario.php">
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
            <h1 class="titulo">Seja bem vindo, <?php echo $dadosUsuario['nomeUsuario']; ?></h1><br>
            <?php
require_once("../Classes/Evento.php");
$evento = new Evento();
$listaevento = $evento->listarTudo();
?>
            <div class="tudo">
                <div class="all">
                    <?php foreach ($listaevento as $evento) { ?>
                    <div class="container">
                        <div class="card" style="width: 18rem;">
                            <form method="POST" action="detalhes-evento.php">
                                <input type="hidden" name="idEvento" value="<?php echo $evento['idEvento']; ?>">
                                <button type="submit" class="btn-img">
                                    <img src="<?php echo $evento['fotoEvento'] ?>" class="card" alt="...">
                                </button>
                            </form>
                            <div class="cardB">
                                <p class="data"><?php echo $evento['dataEvento'] ?></p>
                                <h5 class="title"><?php echo $evento['descEvento'] ?></h5>
                                <p class="card-text"><?php echo $evento['localEvento'] ?></p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="wrapperCC">
        <?php require_once "footer-restrito.php"?>
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
    </div>
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
</body>

</html>