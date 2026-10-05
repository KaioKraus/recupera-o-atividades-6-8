<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo brinquedo | Gestão de Brinquedos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main class="container container-formulario">
        <a class="voltar" href="index.php">&larr; Voltar para a lista</a>
        <section class="painel-formulario">
            <p class="sobretitulo">Cadastro</p>
            <h1>Novo brinquedo</h1>
            <p class="descricao">Preencha os dados para adicionar um item ao estoque.</p>
            <form action="salvar.php" method="post" class="formulario">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" maxlength="150" required>

                <label for="categoria">Categoria</label>
                <input type="text" id="categoria" name="categoria" maxlength="100" required>

                <label for="faixa_etaria">Faixa etária</label>
                <input type="text" id="faixa_etaria" name="faixa_etaria" maxlength="50" placeholder="Ex.: 3 a 6 anos" required>

                <label for="preco">Preço (R$)</label>
                <input type="number" id="preco" name="preco" min="0.01" step="0.01" required>

                <label for="quantidade">Quantidade em estoque</label>
                <input type="number" id="quantidade" name="quantidade" min="0" step="1" required>

                <div class="acoes-formulario">
                    <button class="botao botao-principal" type="submit">Cadastrar brinquedo</button>
                    <a class="botao botao-neutro" href="index.php">Cancelar</a>
                </div>
            </form>
        </section>
    </main>
</body>
</html>