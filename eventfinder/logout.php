<?php

// Inicia a sessão
session_start();

// Destroi todas as variáveis de sessão
session_unset();

// Destrói a sessão
session_destroy();

// Redireciona para a página de login ou para qualquer outra página desejada
echo "<script language= 'javascript' type='text/javascript'>
    alert('Sessão encerrada com sucesso!')
     window.location.href='formLogin.php'</script>";
exit();

?>