<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="area-restrita/css/Style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
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
    <div class="wrapperLLL">
        <div class="login-boxCP">
            <form method="POST" action="./area-restrita/cadastroParceiro.php">
                <table width="600px" border="0" align="center">
                    <h2>Cadastro de Parceiro</h2>

                    <label for="nomeParceiro">Nome:</label>
                    <input class="caixa" type="text" id="nomeParceiro" name="nomeParceiro" required><br><br>

                    <label for="cnpjParceiro">CNPJ:</label>
                    <input class="caixa" type="text" id="cnpjParceiro" name="cnpjParceiro" required><br><br>

                    <label for="celParceiro">Celular:</label>
                    <input class="caixa" type="text" id="celParceiro" name="celParceiro" required><br><br>

                    <label for="emailParceiro">Email:</label>
                    <input class="caixa" type="email" id="emailParceiro" name="emailParceiro" required><br><br>

                    <label for="senhaParceiro">Senha:</label>
                    <input class="caixa" type="password" id="senhaParceiro" name="senhaParceiro" required><br><br>

                    <label for="cep">CEP:</label>
                    <input class="caixa" type="text" id="cep" name="cep" required><br><br>

                    <label for="logradouro">Logradouro:</label>
                    <input class="caixa" type="text" id="logradouro" name="logradouro" required><br><br>

                    <label for="numero">Número:</label>
                    <input class="caixa" type="text" id="numero" name="numero" required><br><br>

                    <label for="bairro">Bairro:</label>
                    <input class="caixa" type="text" id="bairro" name="bairro" required><br><br>

                    <label for="cidade">Cidade:</label>
                    <input class="caixa" type="text" id="cidade" name="cidade" required><br><br>

                    <label for="estado">Estado:</label>
                    <input class="caixa" type="text" id="estado" name="estado" required><br><br>

                    <input class="btn" type="submit" value="Cadastrar">
                </table>
            </form>
        </div>
    </div>
    <?php require_once "footer.php";?>
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
    // Função para preencher os campos do endereço
    function preencherEndereco(dados) {
        document.getElementById('logradouro').value = dados.logradouro;
        document.getElementById('bairro').value = dados.bairro;
        document.getElementById('cidade').value = dados.localidade;
        document.getElementById('estado').value = dados.uf;
    }

    // Função para formatar o CEP removendo caracteres especiais
    function formatarCEP(cep) {
        return cep.replace(/\D/g, '');
    }

    // Função para consultar o CEP
    function consultarCEP() {
        var cep = formatarCEP(document.getElementById('cep').value);

        // Verifica se o CEP possui 8 dígitos
        if (cep.length === 8) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'https://viacep.com.br/ws/' + cep + '/json/');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var dados = JSON.parse(xhr.responseText);
                    preencherEndereco(dados);
                } else {
                    console.log('Erro ao consultar o CEP.');
                }
            };
            xhr.send();
        }
    }

    // Adiciona o evento de escuta ao campo de CEP
    document.getElementById('cep').addEventListener('blur', consultarCEP);
    </script>

</body>

</html>