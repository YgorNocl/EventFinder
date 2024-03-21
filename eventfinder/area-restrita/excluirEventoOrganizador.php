<?php 
    require_once("../Classes/Evento.php");

    if (isset($_POST['idEvento'])) {
        $evento = new Evento();
        $idevento = $_POST['idEvento'];
        $evento->deletar($idevento);
        echo "<script language= 'javascript' type='text/javascript'>
        alert('Evento excluído com sucesso!')
        window.location.href='formCadastrarEventoOrganizador.php'</script>";
    } else {
        echo "<script language= 'javascript' type='text/javascript'>
        alert('Erro ao excluir o Evento!')
        window.location.href='formCadastrarEventoOrganizador.php'</script>";
    }
?>