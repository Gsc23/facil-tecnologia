<?php

function seedDatabase($pdo)
{
    try {
        $sql = file_get_contents(__DIR__ . '/../migration/init.sql');
        $pdo->exec($sql);
        echo "Banco de dados populado com sucesso.\n";
    } catch (PDOException $e) {
        echo "Erro ao popular o banco de dados: " . $e->getMessage() . "\n";
    }
}