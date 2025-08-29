<?php

function testGetAllContracts()
{
    echo "Running test: testGetAllContracts\n";

    $pdo = new PDO('sqlite::memory:');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("
        CREATE TABLE Tb_banco (
            codigo INTEGER PRIMARY KEY,
            nome TEXT NOT NULL
        );

        CREATE TABLE Tb_convenio (
            codigo INTEGER PRIMARY KEY,
            convenio TEXT NOT NULL,
            verba REAL NOT NULL,
            banco INTEGER NOT NULL,
            FOREIGN KEY (banco) REFERENCES Tb_banco(codigo)
        );

        CREATE TABLE Tb_convenio_servico (
            codigo INTEGER PRIMARY KEY,
            convenio INTEGER NOT NULL,
            servico TEXT NOT NULL,
            FOREIGN KEY (convenio) REFERENCES Tb_convenio(codigo)
        );

        CREATE TABLE Tb_contrato (
            codigo INTEGER PRIMARY KEY,
            prazo INTEGER NOT NULL,
            valor REAL NOT NULL,
            data_inclusao TEXT NOT NULL,
            convenio_servico INTEGER NOT NULL,
            FOREIGN KEY (convenio_servico) REFERENCES Tb_convenio_servico(codigo)
        );
    ");

    $pdo->exec("
        INSERT INTO Tb_banco (codigo, nome) VALUES (1, 'Banco A');
        INSERT INTO Tb_convenio (codigo, convenio, verba, banco) VALUES (1, 'Convenio 1', 100000.00, 1);
        INSERT INTO Tb_convenio_servico (codigo, convenio, servico) VALUES (1, 1, 'Servico 1');
        INSERT INTO Tb_contrato (codigo, prazo, valor, data_inclusao, convenio_servico) VALUES (1, 12, 5000.00, '2025-08-28', 1);
    ");

    $contract = new Contract($pdo);

    $contracts = $contract->getAllContracts();

    assertEqual(1, count($contracts), "Deve retornar 1 contrato");
    assertEqual('Banco A', $contracts[0]['nome_banco'], "O nome do banco deve ser 'Banco A'");
    assertEqual(100000.00, $contracts[0]['verba'], "A verba deve ser 100000.00");
    assertEqual(12, $contracts[0]['prazo'], "O prazo deve ser 12 meses");
}