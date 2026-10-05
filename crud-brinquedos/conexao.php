<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conexao = null;

try {
    $conexao = new mysqli('localhost', 'root', '', 'loja_brinquedos');
    $conexao->set_charset('utf8mb4');
} catch (mysqli_sql_exception $erro) {
    $conexao = null;
}