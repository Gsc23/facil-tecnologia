<?php

require_once __DIR__ . '/../app/models/Contract.php';
require_once __DIR__ . '/../app/config/database.php';
require_once __DIR__ . '/ContractControllerTest.php';
require_once __DIR__ . '/DatabaseTest.php';

function assertEqual($expected, $actual, $message = '')
{
    if ($expected === $actual) {
        echo "[PASS] $message\n";
    } else {
        echo "[FAIL] $message\n";
        echo "  Expected: " . var_export($expected, true) . "\n";
        echo "  Got: " . var_export($actual, true) . "\n";
    }
}

function assertTrue($condition, $message = '')
{
    if ($condition) {
        echo "[PASS] $message\n";
    } else {
        echo "[FAIL] $message\n";
    }
}

testGetAllContracts();
testDatabaseConnection();