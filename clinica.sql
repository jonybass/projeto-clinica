
CREATE DATABASE clinica;
USE clinica;


CREATE TABLE imagens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    path VARCHAR(255) NOT NULL
);


CREATE TABLE Usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    imagem_id INT NULL,
    FOREIGN KEY (imagem_id) REFERENCES imagens(id) ON DELETE SET NULL
);


CREATE TABLE Medico (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    especialidade VARCHAR(100) NOT NULL,
    imagem_id INT NULL,
    FOREIGN KEY (imagem_id) REFERENCES imagens(id) ON DELETE SET NULL
);


CREATE TABLE Paciente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    data_nascimento DATE NOT NULL,
    tipo_sanguineo VARCHAR(3) NOT NULL,
    imagem_id INT NULL,
    FOREIGN KEY (imagem_id) REFERENCES imagens(id) ON DELETE SET NULL
);


CREATE TABLE  Consulta (
    id_medico INT NOT NULL,
    id_paciente INT NOT NULL,
    data_hora DATETIME NOT NULL,
    observacoes TEXT,
    PRIMARY KEY (id_medico, id_paciente, data_hora),
    FOREIGN KEY (id_medico) REFERENCES Medico(id) ON DELETE CASCADE,
    FOREIGN KEY (id_paciente) REFERENCES Paciente(id) ON DELETE CASCADE
);


