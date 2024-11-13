CREATE DATABASE IF NOT EXISTS cadastro_pessoas;
USE cadastro_pessoas;

CREATE TABLE IF NOT EXISTS pessoa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo ENUM('Fisico', 'Juridico') NOT NULL,
    nome_completo VARCHAR(255),          
    razao_social VARCHAR(255),           
    cpf VARCHAR(14) UNIQUE,              
    cnpj VARCHAR(18) UNIQUE,             
    email VARCHAR(255),
    telefone VARCHAR(20),
    endereco_completo TEXT,
    data_cadastro DATETIME DEFAULT CURRENT_TIMESTAMP
);