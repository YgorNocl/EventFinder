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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>PÁGINA INICIAL PARCEIRO</title>
</head>

<body>


    <header>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="index-restrito-parceiro.php">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index-restrito-parceiro.php">Home <span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="../logout.php">Sair<span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>

    </header>

    <div class="box">
        <form method="POST" class="escolha" action="salvarAlteracaoParceiro.php">
            <table width="600px" border="0" align="center">
                <h2>Alteração de Parceiro</h2>

                <label for="nomeParceiro">Nome:</label>
                <input class="b" type="text" id="nomeParceiro" name="nomeParceiro" required
                    value=<?php echo $dadosParceiro['nomeParceiro']; ?>><br><br>

                <label for="cnpjParceiro">CNPJ:</label>
                <input class="b" type="text" id="cnpjParceiro" name="cnpjParceiro" required
                    value=<?php echo $dadosParceiro['cnpjParceiro']; ?>><br><br>

                <label for="celParceiro">Celular:</label>
                <input class="b" type="text" id="celParceiro" name="celParceiro" required
                    value=<?php echo $dadosParceiro['celParceiro']; ?>><br><br>

                <label for="emailParceiro">Email:</label>
                <input class="b" type="email" id="emailParceiro" name="emailParceiro" required
                    value=<?php echo $dadosParceiro['emailParceiro']; ?>><br><br>

                <label for="cep">CEP:</label>
                <input class="b" type="text" id="cep" name="cep" required
                    value=<?php echo $dadosParceiro['cep']; ?>><br><br>

                <label for="logradouro">Logradouro:</label>
                <input class="b" type="text" id="logradouro" name="logradouro" required
                    value=<?php echo $dadosParceiro['logradouro']; ?>><br><br>

                <label for="numero">Número:</label>
                <input class="b" type="text" id="numero" name="numero" required
                    value=<?php echo $dadosParceiro['numero']; ?>><br><br>

                <label for="bairro">Bairro:</label>
                <input class="b" type="text" id="bairro" name="bairro" required
                    value=<?php echo $dadosParceiro['bairro']; ?>><br><br>

                <label for="cidade">Cidade:</label>
                <input class="b" type="text" id="cidade" name="cidade" required
                    value=<?php echo $dadosParceiro['cidade']; ?>><br><br>

                <label for="estado">Estado:</label>
                <input class="b" type="text" id="estado" name="estado" required
                    value=<?php echo $dadosParceiro['estado']; ?>><br><br>
                <input type="hidden" name="idParceiro" value="<?php echo $idParceiro ?>">
                <input class="btn" type="submit" value="Alterar">
        </form>
    </div>

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
    <?php require_once("./footer-restrito.php")?>

</body>

</html>