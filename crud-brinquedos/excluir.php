<?php
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php?mensagem=dados_invalidos');
    exit;
}

$id = isset($_POST['id']) && is_string($_POST['id']) ? filter_var($_POST['id'], FILTER_VALIDATE_INT) : false;
if (!$id || $id < 1) {
    header('Location: index.php?mensagem=dados_invalidos');
    exit;
}

if (!$conexao) {
    header('Location: index.php?mensagem=erro_banco');
    exit;
}

try {
    $exclusao = $conexao->prepare('DELETE FROM brinquedos WHERE id = ?');
    $exclusao->bind_param('i', $id);
    $exclusao->execute();
    $excluido = $exclusao->affected_rows > 0;
    $exclusao->close();

    header('Location: index.php?mensagem=' . ($excluido ? 'excluido' : 'nao_encontrado'));
    exit;
} catch (mysqli_sql_exception $erro) {
    header('Location: index.php?mensagem=erro_exclusao');
    exit;
}