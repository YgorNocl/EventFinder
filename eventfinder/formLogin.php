<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="area-restrita/css/Style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <title>PÁGINA INICIAL</title>
</head>

<body>
    <header>
            <nav class="nav-bar">
                <a class="logo" href="index.php"><img src="area-restrita/images/logo/logo.png" class="logo-img"></a>
                <form class="form_inline" method="POST" action="resultados-pesquisa.php">
                    <input class="caixa" type="search" placeholder="Search" aria-label="Search" name="pesquisa">
                    <button class="btn" type="submit">Search</button>
                    </form>
                </div>
                <div class="nav-list">
                
                    
                    <ul>
                        <li class="nav-item"><a href="escolhaCadastro.php" class="nav-link">Cadastre-se</a></li>
                        <li class="nav-item"><a href="formLogin.php" class="nav-link">Login</a></li>
                    </ul>
                </div>
                <div class="mobile-menu-icon">
                    <button onclick="menuShow()"><img class="icon" src="area-restrita/images/nav/open.svg" alt=""></button>
                </div>
            </nav>
            <div class="mobile-menu">
                <ul>
                    <form class="form_inline" method="POST" action="resultados-pesquisa.php">
                    <input class="caixa2" type="search" placeholder="Search" aria-label="Search" name="pesquisa">
                    </form>
                    <li class="nav-item"><a href="escolhaCadastro.php" class="nav-link">Cadastre-se</a></li>
                    <li class="nav-item"><a href="formLogin.php" class="nav-link">Login</a></li>
                </ul>
            </div>
    </header>
    
        <div class="login-box">
            <h2>Login</h2>
            <form class="FL" method="post" action="valida-login.php">
                <div class="user-box">
                    <label>Email:</label>
                    <input class="caixa" type="text" name="email" required />
                </div>
                <div class="user-box">
                    <div class="password-toggle">
                        <label>Senha:</label>
                        <input class="caixa" type="password" name="senha" id="password" required />
                        <div class="toggle-icon" id="toggle-icon">
                            <i class="fa fa-eye"></i>
                        </div>
                    </div>
                </div>
                <a class="testete"><button type="submit" class="myeegs">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        entrar
                </a>
            </form>
        </div>

        <div class="wrapperCL">
        <?php require_once("footer.php")?>
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