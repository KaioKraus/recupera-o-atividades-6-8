CREATE DATABASE IF NOT EXISTS loja_brinquedos
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE loja_brinquedos;

CREATE TABLE IF NOT EXISTS brinquedos (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nome VARCHAR(150) NOT NULL,
    categoria VARCHAR(100) NOT NULL,
    faixa_etaria VARCHAR(50) NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    quantidade INT UNSIGNED NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

INSERT INTO brinquedos (nome, categoria, faixa_etaria, preco, quantidade) VALUES
    ('Blocos de montar', 'Educativo', '4 a 8 anos', 59.90, 18),
    ('Carrinho de corrida', 'Veículos', '3 a 7 anos', 34.50, 25),
    ('Boneca de pano', 'Bonecas', 'A partir de 3 anos', 72.00, 12),
    ('Quebra-cabeça de animais', 'Educativo', '6 a 10 anos', 28.90, 20),
    ('Jogo de memória', 'Jogos', '5 a 9 anos', 22.00, 15);