<?php
    require_once('../Classes/Evento.php');

    

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Cria um objeto Evento com os dados do formulário
        $evento = new Evento();
        $evento->setDescEvento($_POST["descEvento"]);
        $evento->setTipoEvento($_POST["tipoEvento"]);
        $evento->setIdadeMinima($_POST["idadeMinima"]);
        $evento->setPrecoCamarote($_POST["precoCamarote"]);
        $evento->setPrecoPista($_POST["precoPista"]);
        $evento->setLocalEvento($_POST["localEvento"]);
        $evento->setDataEvento($_POST["dataEvento"]);
        $evento->setHoraEvento($_POST["horaEvento"]);
        $evento->setHoraAberturaEvento($_POST["horaAberturaEvento"]);

        // Definir o ID do organizador
        $evento->setIdOrganizador($_POST['idOrganizador']);
    
    $nome = $_FILES['fotoEvento']['name'];
    
    $arquivo = $_FILES['fotoEvento']['tmp_name'];

    $caminhoimagem = "images/evento/" . $nome;
      
    move_uploaded_file($arquivo, $caminhoimagem);
    //mova o $arquivo para a pasta indicada com o nome indicado
        
    $evento->setFotoEvento($caminhoimagem);

    $evento->cadastrarEvento($evento);
   
    echo "<script language= 'javascript' type='text/javascript'>
    alert('Evento adicionado com sucesso!')
     window.location.href='formCadastrarEventoOrganizador.php'</script>";
} else{
    echo "<script language= 'javascript' type='text/javascript'>
    alert('Erro ao adicionar evento!')
     window.location.href='formCadastrarEventoOrganizador.php'</script>";
}
         
?>