<?php
// Inclui o arquivo de validação da sessão
require_once('../valida-session.php');
require_once('../Classes/Organizador.php');
require_once('../Classes/Ingresso.php');

// Cria uma instância da classe Organizador
$organizador = new Organizador();

// Recupera o ID do organizador da variável de sessão
$idOrganizador = $_SESSION['idOrganizador'];

// Busca os dados completos do organizador
$dadosOrganizador = $organizador->buscarOrganizadorPorId($idOrganizador);

// Obtém a contagem de eventos cadastrados pelo organizador
$eventosCadastrados = $organizador->contarEventosCadastrados($idOrganizador);
$eventosCadastradosPorTipo = $organizador->contarEventosCadastradosPorTipo($idOrganizador);


// Obtém a contagem de ingressos vendidos dos eventos cadastrados pelo organizador
$ingressosVendidos = $organizador->contarIngressosEvento($idOrganizador);
$dadosIngressos = $organizador->buscarIngressosVendidos($idOrganizador);
$aa = $organizador->calcularValorTotalIngressosVendidos($idOrganizador);
$valorTotalIngressosCamarote = $organizador->ValorTotalIngressosCamarote($idOrganizador);
$valorTotalIngressosPista= $organizador->ValorTotalIngressosPista($idOrganizador);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Style.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <title>PÁGINA INICIAL RESTRITA ORGANIZADOR</title>
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

    <h1 class="titulo">Dashboard Organizador</h1>

    <div class="boxx">


        <div class="caixa-grande">
            <h3 class="tit">Eventos Cadastrados</h3>
            <p class="cl"><?php echo $eventosCadastrados; ?></p>
        </div>

        <div class="caixa-grande">
            <h3 class="tit">Ingressos Vendidos</h3>
            <p class="cl"><?php echo $ingressosVendidos; ?></p>
        </div>
        <div class="coluna grafico">
            <div id="chart_div_eventos"></div>
        </div>

        <!-- Gráfico de Ingressos Vendidos por Dia -->
        <div class="coluna grafico">
            <div id="chart_div_ingressos"></div>
        </div>
        <div class="caixa-grande">
            <h3 class="tit">Ingressos Camarote Vendidos</h3>
            <p class="cl"><?php echo $dadosIngressos['totalCamarote']; ?></p>
        </div>

        <div class="caixa-grande">
            <h3 class="tit">Ingressos Pista Vendidos</h3>
            <p class="cl"><?php echo $dadosIngressos['totalPista']; ?></p>
        </div>
        <div class="caixa-grande">
            <h3 class="tit">Total Arrecadado Camarote</h3>
            <p class="cl">R$<?php echo $valorTotalIngressosCamarote; ?></p>
        </div>
        <div class="caixa-grande">
            <h3 class="tit">Total Arrecadado Pista</h3>
            <p class="cl">R$<?php echo $valorTotalIngressosPista; ?></p>
        </div>
        <div class="caixa-grande">
            <h3 class="tit">Total Arrecadado </h3>
            <p class="cl">R$<?php echo $aa; ?></p>

        </div>

        <script>
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        // Função para converter a string de data para o tipo Date

        // Busca os ingressos vendidos por dia
        function drawChart() {
            // Gráfico de Eventos Cadastrados
            <?php if (!empty($eventosCadastradosPorTipo)) { ?>
            var dataEventos = google.visualization.arrayToDataTable([
                ['Tipo de Evento', 'Quantidade de Eventos'],
                <?php
            foreach ($eventosCadastradosPorTipo as $evento) {
                $tipoEvento = $evento['tipoEvento'];
                $quantidadeEventos = $evento['totalEventos'];
                echo "['$tipoEvento', $quantidadeEventos],";
            }
            ?>
            ]);
            <?php } else { ?>
            var dataEventos = google.visualization.arrayToDataTable([
                ['', 'Quantidade Eventos'],
                ['Nenhum evento cadastrado', 0]
            ]);
            <?php } ?>

            var optionsEventos = {
                title: 'Eventos Cadastrados por Tipo',
                width: 500,
                height: 400,
                chartArea: {
                    width: '50%'
                },
                hAxis: {
                    title: '',
                    minValue: 0
                },
                vAxis: {
                    title: ''
                },
                colors: ['#191414'] // Define a cor laranja para Eventos Cadastrados
            };

            var chartEventos = new google.visualization.BarChart(document.getElementById('chart_div_eventos'));
            chartEventos.draw(dataEventos, optionsEventos);
            // Gráfico de Ingressos Vendidos por Dia
            <?php if (!empty($dadosIngressos)) { ?>
            var dataIngressos = google.visualization.arrayToDataTable([
                ['Quantidade', 'Camarote'],
                ['Camarote', <?php echo $dadosIngressos['totalCamarote']; ?>],
                ['Pista', <?php echo $dadosIngressos['totalPista']; ?>]
            ]);
            <?php } else { ?>
            var dataIngressos = google.visualization.arrayToDataTable([
                ['Tipo de Ingresso', 'Quantidade'],
                ['Nenhum ingresso vendido', 0]
            ]);
            <?php } ?>


            var optionsIngressos = {
                title: 'Ingressos Vendidos Por Tipo',
                width: 500,
                height: 400,
                chartArea: {
                    width: '50%'
                },
                series: {
                    0: {
                        color: 'rgb(255, 128, 0)'
                    }, // Define a cor laranja para ingressos de camarote
                    1: {
                        color: 'rgb(0, 0, 255)'
                    } // Define a cor azul para ingressos de pista
                }
            };

            var chartIngressos = new google.visualization.ColumnChart(document.getElementById('chart_div_ingressos'));
            chartIngressos.draw(dataIngressos, optionsIngressos);
        }
        </script>
    </div>
    </div>
    <?php
    require_once("../Classes/Evento.php");
    $evento = new Evento();
    $evento->setIdOrganizador($idOrganizador); // Defina o ID do organizador
    $listaEvento = $evento->listar();
    
    ?>
    <div class="tudo">
        <div class="all">
            <?php foreach ($listaEvento as $linha) { ?>
            <div class="container">
                <?php $idEvento = $linha['idEvento']; ?>
                <div class="card" style="width: 18rem;">
                    <img src="<?php echo $linha['fotoEvento']; ?>" alt="Foto do Evento" class="card">
                    <div class="card-body">

                        <?php
                    // Cria uma instância da classe Ingresso
                    $ingresso = new Ingresso();
                    $quantidadesIngressos = $ingresso->contarIngressosPorEvento($idEvento);
                    // Obtém a quantidade de ingressos vendidos para o evento
                    $quantidadeCamarote = $ingresso->contarIngressosPorEvento($idEvento, 'camarote');
                    $quantidadePista = $ingresso->contarIngressosPorEvento($idEvento, 'pista');
                    ?>
                        <p id="card-text" class="tit">Ingressos camarote vendidos:
                            <?php echo $quantidadeCamarote['camarote']; ?></p>
                        <p id="card-text" class="tit">Ingressos pista vendidos: <?php echo $quantidadePista['pista']; ?>
                        </p>


                    </div>
                </div>
            </div>
            <?php } ?>
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