<?php

require_once("../Classes/Evento.php");

// Verifica se o formulário de alteração foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se foi fornecido o parâmetro 'idEvento' no formulário
    if (isset($_POST['idEvento'])) {
        $idEvento = $_POST['idEvento'];
        $evento = new Evento();
        $evento->setIdEvento($idEvento);
         
        // Atualiza os dados do evento com base no formulário enviado
        $evento->setDescEvento($_POST['descEvento']);
        $evento->setTipoEvento($_POST['tipoEvento']);
        
        $nome = $_FILES['fotoEvento']['name'];
        $arquivo = $_FILES['fotoEvento']['tmp_name'];
        $caminhoimagem = "images/evento/" . $nome;
          
        move_uploaded_file($arquivo, $caminhoimagem);
        $evento->setFotoEvento($caminhoimagem);
        
        $evento->setIdadeMinima($_POST['idadeMinima']);
        $evento->setPrecoCamarote($_POST['precoCamarote']);
        $evento->setPrecoPista($_POST['precoPista']);
        $evento->setLocalEvento($_POST['localEvento']);
        $evento->setDataEvento($_POST['dataEvento']);
        $evento->setHoraEvento($_POST['horaEvento']);
        $evento->setHoraAberturaEvento($_POST['horaAberturaEvento']);
        
        // Realiza a alteração do evento
        $resultado = $evento->alterar();

        // Verifica se a alteração foi bem-sucedida
        if ($resultado === "Evento alterado com sucesso.") {
            echo "<script language='javascript' type='text/javascript'>
                  alert('$resultado');
                  window.location.href='formCadastrarEventoOrganizador.php';
                  </script>";
            exit();
        } else {
            echo "<script language='javascript' type='text/javascript'>
                  alert('Erro ao alterar o evento: $resultado');
                  window.location.href='formCadastrarEventoOrganizador.php';
                  </script>";
            exit();
        }
    }
} else {
    // Redireciona para a página principal (evento.php) se o formulário não foi enviado
    echo "<script language='javascript' type='text/javascript'>
    alert('Erro ao pegar os dados do formuçário: $resultado');
    window.location.href='formCadastrarEventoOrganizador.php';
    </script>";
    exit();
}
?>
