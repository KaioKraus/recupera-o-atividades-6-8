<?php
require_once 'conexao.php';

$mensagens = [
    'cadastrado' => ['sucesso', 'Brinquedo cadastrado com sucesso!'],
    'atualizado' => ['sucesso', 'Brinquedo atualizado com sucesso!'],
    'excluido' => ['sucesso', 'Brinquedo excluído com sucesso!'],
    'nao_encontrado' => ['erro', 'Brinquedo não encontrado.'],
    'dados_invalidos' => ['erro', 'Confira os dados informados e tente novamente.'],
    'erro_cadastro' => ['erro', 'Erro ao cadastrar o brinquedo.'],
    'erro_atualizacao' => ['erro', 'Erro ao atualizar o brinquedo.'],
    'erro_exclusao' => ['erro', 'Erro ao excluir o brinquedo.'],
    'erro_banco' => ['erro', 'Não foi possível conectar ao banco de dados. Verifique a configuração do MySQL.'],
];
$mensagem = null;
$codigoMensagem = $_GET['mensagem'] ?? '';
if (is_string($codigoMensagem) && isset($mensagens[$codigoMensagem])) {
    $mensagem = $mensagens[$codigoMensagem];
}

$brinquedos = [];
$erroBanco = !$conexao;

if ($conexao) {
    try {
        $consulta = $conexao->prepare('SELECT id, nome, categoria, faixa_etaria, preco, quantidade FROM brinquedos ORDER BY id DESC');
        $consulta->execute();
        $resultado = $consulta->get_result();
        $brinquedos = $resultado->fetch_all(MYSQLI_ASSOC);
        $consulta->close();
    } catch (mysqli_sql_exception $erro) {
        $erroBanco = true;
    }
}

if ($erroBanco) {
    $mensagem = ['erro', 'Não foi possível carregar os brinquedos. Confira o banco de dados e tente novamente.'];
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestão de Brinquedos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main class="container">
        <header class="topo">
            <div>
                <p class="sobretitulo">Loja de brinquedos</p>
                <h1>Sistema de Gestão de Brinquedos</h1>
            </div>
            <a class="botao botao-principal" href="cadastrar.php">Novo Brinquedo</a>
        </header>

        <?php if ($mensagem): ?>
            <div class="mensagem mensagem-<?= htmlspecialchars($mensagem[0], ENT_QUOTES, 'UTF-8') ?>" role="status">
                <?= htmlspecialchars($mensagem[1], ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <section class="secao-lista" aria-labelledby="titulo-lista">
            <div class="cabecalho-secao">
                <h2 id="titulo-lista">Brinquedos cadastrados</h2>
                <span class="contador"><?= count($brinquedos) ?> item(ns)</span>
            </div>

            <?php if (!$erroBanco && count($brinquedos) === 0): ?>
                <p class="estado-vazio">Nenhum brinquedo cadastrado. Use “Novo Brinquedo” para começar.</p>
            <?php elseif (!$erroBanco): ?>
                <div class="tabela-responsiva">
                    <table>
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Faixa etária</th>
                                <th scope="col">Preço</th>
                                <th scope="col">Estoque</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($brinquedos as $brinquedo): ?>
                                <tr>
                                    <td><?= (int) $brinquedo['id'] ?></td>
                                    <td><?= htmlspecialchars($brinquedo['nome'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($brinquedo['categoria'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($brinquedo['faixa_etaria'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td>R$ <?= number_format((float) $brinquedo['preco'], 2, ',', '.') ?></td>
                                    <td><?= (int) $brinquedo['quantidade'] ?></td>
                                    <td class="acoes">
                                        <a class="botao botao-secundario" href="editar.php?id=<?= (int) $brinquedo['id'] ?>">Editar</a>
                                        <form action="excluir.php" method="post" onsubmit="return confirm('Tem certeza de que deseja excluir este brinquedo?');">
                                            <input type="hidden" name="id" value="<?= (int) $brinquedo['id'] ?>">
                                            <button class="botao botao-perigo" type="submit">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </section>
        <footer class="rodape">Gestão simples e organizada do estoque da loja.</footer>
    </main>
</body>
</html>