<?php

require_once __DIR__ . '/../models/Contract.php';

class ContractController
{
    private $contractModel;

    public function __construct($pdo)
    {
        $this->contractModel = new Contract($pdo);
    }

    public function index()
    {
        return $this->contractModel->getAllContracts();
    }
}