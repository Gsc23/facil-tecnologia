SELECT 
    b.nome AS nome_banco,
    c.verba,
    MIN(ct.data_inclusao) AS data_contrato_mais_antigo,
    MAX(ct.data_inclusao) AS data_contrato_mais_novo,
    SUM(ct.valor) AS soma_valores
FROM Tb_contrato ct
JOIN Tb_convenio_servico cs ON ct.convenio_servico = cs.codigo
JOIN Tb_convenio c ON cs.convenio = c.codigo
JOIN Tb_banco b ON c.banco = b.codigo
GROUP BY 
    b.nome,
    c.verba;
