-- Criação das tabelas
CREATE TABLE IF NOT EXISTS Tb_banco (
    codigo INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS Tb_convenio (
    codigo INT AUTO_INCREMENT PRIMARY KEY,
    convenio VARCHAR(255) NOT NULL,
    verba DECIMAL(15, 2) NOT NULL,
    banco INT NOT NULL,
    FOREIGN KEY (banco) REFERENCES Tb_banco(codigo)
);

CREATE TABLE IF NOT EXISTS Tb_convenio_servico (
    codigo INT AUTO_INCREMENT PRIMARY KEY,
    convenio INT NOT NULL,
    servico VARCHAR(255) NOT NULL,
    FOREIGN KEY (convenio) REFERENCES Tb_convenio(codigo)
);

CREATE TABLE IF NOT EXISTS Tb_contrato (
    codigo INT AUTO_INCREMENT PRIMARY KEY,
    prazo INT NOT NULL,
    valor DECIMAL(15, 2) NOT NULL,
    data_inclusao DATE NOT NULL,
    convenio_servico INT NOT NULL,
    FOREIGN KEY (convenio_servico) REFERENCES Tb_convenio_servico(codigo)
);

-- Inserção de dados de teste
INSERT INTO Tb_banco (nome) VALUES ('Banco A'), ('Banco B');

INSERT INTO Tb_convenio (convenio, verba, banco) VALUES 
('Convenio 1', 100000.00, 1),
('Convenio 2', 200000.00, 2);

INSERT INTO Tb_convenio_servico (convenio, servico) VALUES 
(1, 'Servico 1'),
(2, 'Servico 2');

INSERT INTO Tb_contrato (prazo, valor, data_inclusao, convenio_servico) VALUES 
(12, 5000.00, '2025-08-28', 1),
(24, 10000.00, '2025-08-27', 2);