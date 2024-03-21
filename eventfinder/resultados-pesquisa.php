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
    <?php
$diaSemana = [
    'Sun' => 'DOM',
    'Mon' => 'SEG',
    'Tue' => 'TER',
    'Wed' => 'QUA',
    'Thu' => 'QUI',
    'Fri' => 'SEX',
    'Sat' => 'SAB'
];

$meses = [
    'Jan' => 'JAN',
    'Feb' => 'FEV',
    'Mar' => 'MAR',
    'Apr' => 'ABR',
    'May' => 'MAI',
    'Jun' => 'JUN',
    'Jul' => 'JUL',
    'Aug' => 'AGO',
    'Sep' => 'SET',
    'Oct' => 'OUT',
    'Nov' => 'NOV',
    'Dec' => 'DEZ'
];

function formatarDataHora($data, $hora, $diaSemana, $meses) {
    $dataFormatada = $diaSemana[date('D', strtotime($data))];
    $dataFormatada .= date(', d', strtotime($data));
    $dataFormatada .= $meses[date('M', strtotime($data))];
    $horaFormatada = date(' . H:i', strtotime($hora));
    return mb_strtoupper($dataFormatada, 'UTF-8') . $horaFormatada;
}
?>

        <?php
require_once("Classes/Evento.php");
if (isset($_POST['pesquisa'])) {
    $termoPesquisa = $_POST['pesquisa'];
    $evento = new Evento();
    $resultados = $evento->pesquisarEventos($termoPesquisa);
?>

        <div class="tudoP">
            <div class="allP">
                <?php foreach ($resultados as $resultado) { ?>
                <div class="container">
                    <div class="container">
                        <div class="card" style="width: 18rem;">
                            <button type="submit" class="btn-img">
                            <a href="formLogin.php"><img src="area-restrita/<?php echo $resultado['fotoEvento'] ?>" class="cardG" alt="..."></a>
                            </button>
                            <p class="data"><?php echo formatarDataHora($resultado['dataEvento'], $resultado['horaEvento'], $diaSemana, $meses) ?></p>
                            <h5 class="title"><?php echo $resultado['descEvento'] ?></h5>
                            <p class="card-text"><?php echo $resultado['localEvento'] ?></p>
                          
                        </div>
                    </div>
                </div>
            
    <?php } ?>
    <?php } ?>
    </div>
        </div> 
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
</body>

</html>