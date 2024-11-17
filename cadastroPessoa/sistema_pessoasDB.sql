#criar database#
CREATE DATABASE sistema_pessoas;

USE sistema_pessoas;

CREATE TABLE pessoa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo ENUM('Físico', 'Jurídico') NOT NULL,
    nome_completo VARCHAR(255) DEFAULT NULL,
    razao_social VARCHAR(255) DEFAULT NULL,
    cpf VARCHAR(14) UNIQUE DEFAULT NULL,
    cnpj VARCHAR(18) UNIQUE DEFAULT NULL,
    email VARCHAR(255) DEFAULT NULL,
    telefone VARCHAR(20) DEFAULT NULL,
    endereco_completo VARCHAR(10000) DEFAULT NULL,
    cidade VARCHAR(100) DEFAULT NULL,
    estado VARCHAR(2) DEFAULT NULL,
    cep VARCHAR(10) DEFAULT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE pessoa
    ADD CONSTRAINT chk_cpf_cnpj CHECK (
        (tipo = 'Físico' AND cpf IS NOT NULL) OR (tipo = 'Jurídico' AND cnpj IS NOT NULL)
    );

#comando para criar a view#
CREATE VIEW vw_pessoas AS
SELECT 
    id,
    tipo,
    CASE
        WHEN tipo = 'Físico' THEN nome_completo
        ELSE razao_social
    END AS nome,
    CASE
        WHEN tipo = 'Físico' THEN cpf
        ELSE cnpj
    END AS documento,
    email,
    telefone,
    CONCAT(endereco_completo, ', ', cidade, ', ', estado, ', ', cep) AS endereco_completo,
    data_cadastro
FROM pessoa;

#view para consultar registo#
SELECT * FROM vw_pessoas;
