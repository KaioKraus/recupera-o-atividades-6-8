<?php
require_once 'conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id || $id < 1) {
    header('Location: index.php?mensagem=dados_invalidos');
    exit;
}

$brinquedo = null;
if ($conexao) {
    try {
        $consulta = $conexao->prepare('SELECT id, nome, categoria, faixa_etaria, preco, quantidade FROM brinquedos WHERE id = ?');
        $consulta->bind_param('i', $id);
        $consulta->execute();
        $resultado = $consulta->get_result();
        $brinquedo = $resultado->fetch_assoc();
        $consulta->close();
    } catch (mysqli_sql_exception $erro) {
        header('Location: index.php?mensagem=erro_banco');
        exit;
    }
}

if (!$brinquedo) {
    header('Location: index.php?mensagem=' . ($conexao ? 'nao_encontrado' : 'erro_banco'));
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar brinquedo | Gestão de Brinquedos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main class="container container-formulario">
        <a class="voltar" href="index.php">&larr; Voltar para a lista</a>
        <section class="painel-formulario">
            <p class="sobretitulo">Edição · ID <?= (int) $brinquedo['id'] ?></p>
            <h1>Editar brinquedo</h1>
            <p class="descricao">Atualize os dados do item selecionado.</p>
            <form action="atualizar.php" method="post" class="formulario">
                <input type="hidden" name="id" value="<?= (int) $brinquedo['id'] ?>">

                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" maxlength="150" value="<?= htmlspecialchars($brinquedo['nome'], ENT_QUOTES, 'UTF-8') ?>" required>

                <label for="categoria">Categoria</label>
                <input type="text" id="categoria" name="categoria" maxlength="100" value="<?= htmlspecialchars($brinquedo['categoria'], ENT_QUOTES, 'UTF-8') ?>" required>

                <label for="faixa_etaria">Faixa etária</label>
                <input type="text" id="faixa_etaria" name="faixa_etaria" maxlength="50" value="<?= htmlspecialchars($brinquedo['faixa_etaria'], ENT_QUOTES, 'UTF-8') ?>" required>

                <label for="preco">Preço (R$)</label>
                <input type="number" id="preco" name="preco" min="0.01" step="0.01" value="<?= htmlspecialchars((string) $brinquedo['preco'], ENT_QUOTES, 'UTF-8') ?>" required>

                <label for="quantidade">Quantidade em estoque</label>
                <input type="number" id="quantidade" name="quantidade" min="0" step="1" value="<?= (int) $brinquedo['quantidade'] ?>" required>

                <div class="acoes-formulario">
                    <button class="botao botao-principal" type="submit">Salvar alterações</button>
                    <a class="botao botao-neutro" href="index.php">Cancelar</a>
                </div>
            </form>
        </section>
    </main>
</body>
</html>