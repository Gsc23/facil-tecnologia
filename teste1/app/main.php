<?php

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/controller/ContractController.php';

$config = require __DIR__ . '/config/database.php';

try {
    $pdo = new PDO(
        "mysql:host={$config['host']};dbname={$config['database']}",
        $config['username'],
        $config['password']
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $controller = new ContractController($pdo);
    $contracts = $controller->index();

    header('Content-Type: application/json');
    echo json_encode($contracts);

} catch (PDOException $e) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Erro na conexão com o banco de dados: ' . $e->getMessage()]);
}