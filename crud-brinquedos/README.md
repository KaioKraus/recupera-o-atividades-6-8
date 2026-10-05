# Sistema de Gestão de Brinquedos

## Descrição

Aplicação web simples para controlar os brinquedos e as quantidades em estoque de uma loja. O sistema permite cadastrar, consultar, editar e excluir brinquedos.

## Objetivo

Praticar operações CRUD, validação de dados, tratamento de erros e acesso seguro ao MySQL usando Prepared Statements.

## Tecnologias

- PHP com MySQLi
- MySQL
- HTML
- CSS

## Funcionalidades

- Listar brinquedos com ID, nome, categoria, faixa etária, preço e estoque.
- Cadastrar novos brinquedos.
- Editar os dados de um brinquedo existente.
- Excluir um brinquedo após confirmação.
- Validar campos e exibir mensagens simples de sucesso ou erro.
- Usar Prepared Statements nas consultas ao banco.

## Estrutura dos arquivos

```text
crud-brinquedos/
├── index.php       # Página inicial e listagem
├── cadastrar.php   # Formulário de cadastro
├── editar.php      # Formulário de edição
├── excluir.php     # Exclusão com confirmação
├── conexao.php     # Conexão com o MySQL
├── salvar.php      # Validação e cadastro
├── atualizar.php   # Validação e atualização
├── style.css       # Estilos das páginas
├── banco.sql       # Criação do banco, tabela e dados de exemplo
└── README.md       # Este arquivo
```

## Configurar o banco de dados

1. Inicie o Apache e o MySQL no XAMPP.
2. Abra o phpMyAdmin em `http://localhost/phpmyadmin`.
3. Importe o arquivo `banco.sql` pela opção **Importar**. Ele cria o banco `loja_brinquedos`, a tabela `brinquedos` e cinco registros de exemplo.
4. A conexão padrão em `conexao.php` usa `localhost`, usuário `root` e senha vazia, como na configuração padrão do XAMPP. Se sua instalação usar outros dados, ajuste essas configurações nesse arquivo.

## Executar no XAMPP

1. Coloque a pasta `crud-brinquedos` dentro de `C:\xampp\htdocs\`.
2. Confirme que Apache e MySQL estão em execução e que o banco foi importado.
3. Acesse `http://localhost/crud-brinquedos/` no navegador.

Se o projeto estiver em uma subpasta diferente dentro de `htdocs`, ajuste o endereço no navegador para incluir o nome dessa subpasta.

## Publicar no GitHub

1. Crie um repositório no GitHub.
2. Envie a pasta `crud-brinquedos` com os dez arquivos deste projeto para o repositório.
3. Confira no GitHub se `banco.sql` e este `README.md` também foram publicados.