-- Criar o banco de dados
CREATE DATABASE IF NOT EXISTS clinica;
USE clinica;

-- Tabela de usuários (login)
CREATE TABLE Usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL
);

-- Tabela de médicos
CREATE TABLE Medico (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    especialidade VARCHAR(100) NOT NULL
);

-- Tabela de pacientes
CREATE TABLE Paciente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    data_nascimento DATE NOT NULL,
    tipo_sanguineo VARCHAR(3) NOT NULL
);

-- Tabela de consultas (relacionamento N:N)
CREATE TABLE Consulta (
    id_medico INT NOT NULL,
    id_paciente INT NOT NULL,
    data_hora DATETIME NOT NULL,
    observacoes TEXT,
    PRIMARY KEY (id_medico, id_paciente, data_hora),
    FOREIGN KEY (id_medico) REFERENCES Medico(id) ON DELETE CASCADE,
    FOREIGN KEY (id_paciente) REFERENCES Paciente(id) ON DELETE CASCADE
);

-- Criar a tabela de imagens
CREATE TABLE imagens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    path VARCHAR(255) NOT NULL
);

-- Adicionar a chave estrangeira na tabela alunos
ALTER TABLE Paciente
ADD COLUMN imagem_id INT,
ADD FOREIGN KEY (imagem_id) REFERENCES imagens(id) ON DELETE SET NULL;