<?php
require_once 'conexao.php';

function voltarParaInicio(string $mensagem): void
{
    header('Location: index.php?mensagem=' . urlencode($mensagem));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    voltarParaInicio('dados_invalidos');
}

$nome = isset($_POST['nome']) && is_string($_POST['nome']) ? trim($_POST['nome']) : '';
$categoria = isset($_POST['categoria']) && is_string($_POST['categoria']) ? trim($_POST['categoria']) : '';
$faixaEtaria = isset($_POST['faixa_etaria']) && is_string($_POST['faixa_etaria']) ? trim($_POST['faixa_etaria']) : '';
$precoInformado = isset($_POST['preco']) && is_string($_POST['preco']) ? trim($_POST['preco']) : '';
$quantidadeInformada = isset($_POST['quantidade']) && is_string($_POST['quantidade']) ? $_POST['quantidade'] : '';

$precoValido = is_numeric($precoInformado) && is_finite((float) $precoInformado) && (float) $precoInformado > 0;
$quantidade = filter_var($quantidadeInformada, FILTER_VALIDATE_INT);

if ($nome === '' || strlen($nome) > 150 || $categoria === '' || strlen($categoria) > 100 ||
    $faixaEtaria === '' || strlen($faixaEtaria) > 50 || !$precoValido ||
    $quantidade === false || $quantidade < 0 || !$conexao) {
    voltarParaInicio(!$conexao ? 'erro_banco' : 'dados_invalidos');
}

$preco = (float) $precoInformado;

try {
    $insercao = $conexao->prepare('INSERT INTO brinquedos (nome, categoria, faixa_etaria, preco, quantidade) VALUES (?, ?, ?, ?, ?)');
    $insercao->bind_param('sssdi', $nome, $categoria, $faixaEtaria, $preco, $quantidade);
    $insercao->execute();
    $insercao->close();
    voltarParaInicio('cadastrado');
} catch (mysqli_sql_exception $erro) {
    voltarParaInicio('erro_cadastro');
}