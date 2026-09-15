<?php

function iniciarSessao(): void
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
}

function voltarPara(string $pagina, string $mensagem): never
{
    iniciarSessao();
    $_SESSION['mensagem_erro'] = $mensagem;

    header('Location: ../front/php/' . $pagina);
    exit;
}
?>