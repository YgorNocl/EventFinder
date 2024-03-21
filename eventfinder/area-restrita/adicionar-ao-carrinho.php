<?php
// Inclua o arquivo de validação da sessão
require_once('../valida-session.php');

// Verifique se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifique se o ID do evento e a quantidade foram fornecidos
    if (isset($_POST['idEvento']) && isset($_POST['quantidade'])) {
        $idEvento = $_POST['idEvento'];
        $quantidade = $_POST['quantidade'];

        // Verifique se o carrinho existe na sessão
        if (!isset($_SESSION['carrinho'])) {
            // Se o carrinho não existir, crie um array vazio
            $_SESSION['carrinho'] = array();
        }

        // Adicione o evento e a quantidade ao carrinho
        $_SESSION['carrinho'][$idEvento] = $quantidade;

        // Redirecione de volta para a página do evento
        header('Location: carrinho.php?id=' . $idEvento);
        exit;
    }
}