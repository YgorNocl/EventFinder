<?php
// Inclui o arquivo de validação da sessão
require_once('../valida-session.php');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <title>PÁGINA ALTERAR DADOS</title>
</head>

<body>
<header>
            <nav class="nav-bar">
                <a class="logo" href="index-restrito-usuario.php"><img src="images/logo/logo.png" class="logo-img"></a>
                <form class="form_inline" method="POST" action="../resultados-pesquisa.php">
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
require_once('../Classes/Usuario.php');

// Cria uma instância da classe Organizador
$usuario = new Usuario();

// Recupera o ID do organizador da variável de sessão
$idUsuario = $_SESSION['idUsuario'];

// Busca os dados completos do organizador
$dadosUsuario= $usuario->buscarUsuarioPorId($idUsuario);
?>
    <div class="wrapperLL">
        <div class="login-boxAU">
            <div class="user-boxAU">
                <h2>Alterar Dados</h2>
                <form class="" method="post" action="salvarAlteracaoUsuario.php">

                    <label>Nome:</label>
                    <input class="caixa" required type="text" name="nomeUsuario" required
                        value=<?php echo $dadosUsuario['nomeUsuario']; ?>><br><br>

                    <label>Documento:</label>
                    <input class="caixa" required type="number" name="cpfUsuario" required
                        value=<?php echo $dadosUsuario['cpfUsuario']; ?>><br><br>

                    <label>Data de Nascimento:</label>
                    <input class="caixa" type="date" required name="dataNasc" required
                        value=<?php echo $dadosUsuario['dataNasc']; ?>><br><br>

                    <label>Sexo:</label>
                    <select class="caixa" id="sexo" name="sexoUsuario" required>
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                        <option value="Outro">Outro</option>
                    </select><br><br>
                    <label>Celular:</label>
                    <input class="caixa" required type="number" name="celUsuario" required
                        value=<?php echo $dadosUsuario['celUsuario']; ?>><br><br>

                    <label>Email:</label>
                    <input class="caixa" required type="email" name="emailUsuario" required
                        value=<?php echo $dadosUsuario['emailUsuario']; ?>><br><br>
                    <div class="button">
                        <input type="hidden" name="idUsuario" value="<?php echo $idUsuario ?>">
                        <button type="submit" class="btnCI">Alterar</button>
                        <form action="index-restrito-usuario.php">
                            <button type="submit" class="btnCI">Volte para o início</button>
                        </form>
                    </div>
                </form>

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