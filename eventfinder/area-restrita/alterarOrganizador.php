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
    <script src="js/validar-alterar-org.js"></script>
</head>

<body>


<header>
            <nav class="nav-bar">
                <a class="logo" href="index-restrito-organizador.php"><img src="images/logo/logo.png" class="logo-img"></a>
                <form class="form_inline" method="POST" action="resultados-pesquisa-organizador.php">
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
                    <li class="nav-item"><a href="formCadastrarEventoOrganizador.php" class="nav-link">Eventos</a></li>
                    <li class="nav-item"><a href="perfilOrganizador.php" class="nav-link">Perfil</a></li>
                    <li class="nav-item"><a href="../logout.php" class="nav-link">Sair</a></li>
                </ul>
            </div>
    </header>

    <?php
require_once('../Classes/Organizador.php');

// Cria uma instância da classe Organizador
$organizador = new Organizador();

// Recupera o ID do organizador da variável de sessão
$idOrganizador = $_SESSION['idOrganizador'];

// Busca os dados completos do organizador
$dadosOrganizador = $organizador->buscarOrganizadorPorId($idOrganizador);
?>
    
        <div class="login-boxAU">
            <div class="user-boxAU">
                <h2>Alterar Dados</h2>

                <form method="post" action="salvarAlteracaoOrganizador.php"
                    onsubmit="return validarFormularioOrganizador();">

                    <label>Nome:</label>
                    <input class="caixa" required type="text" id="nome" name="nomeOrganizador" required
                        value=<?php echo $dadosOrganizador['nomeOrganizador']; ?>><br>

                    <label>Documento:</label>
                    <div>
                        <input class="caixa" required type="text" id="documento" name="docOrganizador" required
                            value="<?php echo $dadosOrganizador['docOrganizador']; ?>">
                        <span id="documentoError" class="error-message"></span>
                    </div>

                    <label>Data de Nascimento:</label>
                    <div>
                        <input class="caixa" type="date" required name="dataNasc" id="dataNascimento" required
                            value="<?php echo $dadosOrganizador['dataNasc']; ?>">
                        <span id="dataNascimentoError" class="error-message"></span>
                    </div>
                    <label for="sexo">Sexo :</label>
                    <select class="caixa" id="sexo" name="sexoOrganizador">
                        <option value="Outro"></option>
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                        <option value="Outro">Outro</option>
                    </select><br><br>
                    <label>Celular:</label>
                    <div>
                        <input class="caixa" required type="text" id="celular" name="celOrganizador" required
                            value="<?php echo $dadosOrganizador['celOrganizador']; ?>">
                        <span id="celularError" class="error-message"></span>
                    </div>

                    <label>Email:</label>
                    <div>
                        <input class="caixa" required type="email" id="email" name="emailOrganizador" required
                            value="<?php echo $dadosOrganizador['emailOrganizador']; ?>">
                        <span id="emailError" class="error-message"></span>
                    </div>
                    <input type="hidden" name="idOrganizador" value="<?php echo $idOrganizador ?>">
                    <a>
                        <div class="button">
                            <button type="submit" class="btnCI">Alterar</button>
                </form>
                <form action="index-restrito-organizador.php">
                    <button type="submit" class="btnCI">Volte para o início</button>
                </form>
            </div>
        </div>
    </div>
    </div>

    </form>
    <div class="wrapperL">
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