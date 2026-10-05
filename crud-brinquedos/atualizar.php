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

$id = isset($_POST['id']) && is_string($_POST['id']) ? filter_var($_POST['id'], FILTER_VALIDATE_INT) : false;
$nome = isset($_POST['nome']) && is_string($_POST['nome']) ? trim($_POST['nome']) : '';
$categoria = isset($_POST['categoria']) && is_string($_POST['categoria']) ? trim($_POST['categoria']) : '';
$faixaEtaria = isset($_POST['faixa_etaria']) && is_string($_POST['faixa_etaria']) ? trim($_POST['faixa_etaria']) : '';
$precoInformado = isset($_POST['preco']) && is_string($_POST['preco']) ? trim($_POST['preco']) : '';
$quantidadeInformada = isset($_POST['quantidade']) && is_string($_POST['quantidade']) ? $_POST['quantidade'] : '';

$precoValido = is_numeric($precoInformado) && is_finite((float) $precoInformado) && (float) $precoInformado > 0;
$quantidade = filter_var($quantidadeInformada, FILTER_VALIDATE_INT);

if (!$id || $id < 1 || $nome === '' || strlen($nome) > 150 || $categoria === '' || strlen($categoria) > 100 ||
    $faixaEtaria === '' || strlen($faixaEtaria) > 50 || !$precoValido ||
    $quantidade === false || $quantidade < 0 || !$conexao) {
    voltarParaInicio(!$conexao ? 'erro_banco' : 'dados_invalidos');
}

$preco = (float) $precoInformado;

try {
    $verificacao = $conexao->prepare('SELECT id FROM brinquedos WHERE id = ?');
    $verificacao->bind_param('i', $id);
    $verificacao->execute();
    $existe = $verificacao->get_result()->num_rows > 0;
    $verificacao->close();

    if (!$existe) {
        voltarParaInicio('nao_encontrado');
    }

    $atualizacao = $conexao->prepare('UPDATE brinquedos SET nome = ?, categoria = ?, faixa_etaria = ?, preco = ?, quantidade = ? WHERE id = ?');
    $atualizacao->bind_param('sssdii', $nome, $categoria, $faixaEtaria, $preco, $quantidade, $id);
    $atualizacao->execute();
    $atualizacao->close();
    voltarParaInicio('atualizado');
} catch (mysqli_sql_exception $erro) {
    voltarParaInicio('erro_atualizacao');
}