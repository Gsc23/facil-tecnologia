# Sistema de Consulta de Contratos

Este projeto é um **Teste Técnico** para a empresa **Fácil Tecnologia** que realiza consultas em um banco de dados MySQL e retorna os resultados no formato JSON. Ele lista informações sobre contratos, incluindo **nome do banco, verba, código do contrato, data de inclusão, valor e prazo**.

---

## Pré-requisitos

Antes de executar o script, certifique-se de ter:

1. **Servidor Web com PHP**
   * Apache, Nginx ou qualquer outro servidor configurado para rodar PHP.

2. **Banco de Dados MySQL**
   * Com as seguintes tabelas:
     * `Tb_contrato`
     * `Tb_convenio_servico`
     * `Tb_convenio`
     * `Tb_banco`

3. **Variáveis de Ambiente**
   Configure as seguintes variáveis no sistema ou no servidor:
   ```env
   DB_HOST      # Endereço do servidor MySQL
   DB_DATABASE  # Nome do banco de dados
   DB_USERNAME  # Usuário do banco
   DB_PASSWORD  # Senha do banco
   ```

4. **Drivers de banco**
   * **SQLite**: para testes unitários
   * **MySQL**: para execução do projeto

---

## Configuração

1. **Clone o repositório**
```bash
git clone <URL_DO_REPOSITORIO>
cd facil-teste-tecnico
```

2. **Configure as variáveis de ambiente**
   * Linux:
```bash
export DB_HOST="localhost"
export DB_DATABASE="nome_do_banco"
export DB_USERNAME="usuario"
export DB_PASSWORD="senha"
```

3. **Popule o banco de dados**
   * Insira os dados necessários nas tabelas mencionadas.

---

## Execução com Docker

O projeto possui dois ambientes configuráveis:

| Arquivo                  | Propósito                                          |
| ------------------------ | -------------------------------------------------- |
| `docker-compose.dev.yml` | Banco local simulado para desenvolvimento e testes |
| `docker-compose.yml`     | Conexão com banco real, sem dados simulados        |

### Banco Local (Desenvolvimento)

1. Execute o container:
```bash
docker compose -f docker/docker-compose.dev.yml up -d --build
```

2. Acesse o endpoint:
```
http://localhost:8000/main.php
```

---

### Banco Externo (Produção / Real)

1. Configure o `.env` com os dados do banco real:
```env
DB_HOST=ip_ou_hostname
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha
```

2. Execute o container:
```bash
docker compose up -d --build
```

3. Acesse o endpoint:
```
http://localhost:8000/main.php
```

---

## Execução sem Docker

1. Inicie o servidor PHP:
```bash
php -S localhost:8000
```

2. Acesse no navegador:
```
http://localhost:8000/main.php
```

3. Resultado esperado:
```json
[
    {
        "nome_banco": "Banco A",
        "verba": 100000,
        "codigo_contrato": 1,
        "data_inclusao": "2025-08-28",
        "valor": 5000,
        "prazo": 12
    },
    {
        "nome_banco": "Banco B",
        "verba": 200000,
        "codigo_contrato": 2,
        "data_inclusao": "2025-08-27",
        "valor": 10000,
        "prazo": 24
    }
]
```

## Execução de Migrations

Migrations podem ser executadas com o comando `php database/seeders/run_migrate.php`.

## Execução de Testes Unitários

Os testes unitários podem ser executados de duas formas:
* Dentro do `docker-compose.dev.yml`, onde eles são executados no banco simulado que carrega os dados do arquivo de migration (`init.sql`).

* Diretamente no terminal com o comando `php tests/test.php`

---

## Tratamento de Erros

Em caso de falha na conexão com o banco, o script retorna:

```json
{
    "error": "Erro na conexão com o banco de dados: <mensagem_de_erro>"
}
```

---

## Observações

* Certifique-se de que os nomes das tabelas e campos no banco correspondem exatamente aos utilizados no script.
* Para produção, evite exibir mensagens de erro detalhadas para o usuário final.

---

## Licença

Este projeto é de uso interno. Consulte o autor para mais informações.