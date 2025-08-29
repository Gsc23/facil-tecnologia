<?php

function testDatabaseConnection()
{
    echo "Running test: testDatabaseConnection\n";

    $config = require __DIR__ . '/../app/config/database.php';

    try {
        $pdo = new PDO(
            "mysql:host={$config['host']};dbname={$config['database']}",
            $config['username'],
            $config['password']
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        assertTrue($pdo instanceof PDO, "A conexão com o banco de dados deve ser bem-sucedida");
    } catch (PDOException $e) {
        echo "[FAIL] Falha ao conectar ao banco de dados: " . $e->getMessage() . "\n";
    }
}