# Cadastro de Pessoas

## Requisitos

- PHP 7.4+
- MySQL
- Adianti Framework

## Configuração

1. Clone o repositório:
   ```bash
   git clone <repository-url>
   ```

2. Configure o banco de dados:
   - Edite o arquivo `Sys/app/config/cadastroPF-PJ.ini` com as credenciais do seu banco de dados.

3. Importe o banco de dados:
   ```bash
   mysql -u root -p cadastro_pessoas < database.sql
   ```

4. Acesse o sistema:
   - Abra o navegador e acesse `http://localhost/seu-projeto`.

## Funcionalidades

- Cadastro de novas pessoas
- Listagem de pessoas cadastradas
- Edição de dados das pessoas cadastradas
- Exclusão de registros

## Regras de Negócio

- CPF e CNPJ devem ser validados e únicos.
- O campo "Tipo" determina quais campos são obrigatórios.
- Data de Cadastro preenchida automaticamente e não editável.
```

### 6. Estrutura de Código e Boas Práticas

- Utilize a estrutura de pastas do Adianti Framework.
- Siga padrões de nomenclatura consistentes.
- Adicione comentários explicativos onde necessário.

### 7. Entrega

- Suba o código-fonte para um repositório Git (GitHub, GitLab).
- Inclua a documentação (README) explicando como configurar e rodar o projeto.

Com esses passos, você terá implementado as funcionalidades solicitadas seguindo as boas práticas do Adianti Framework.

Similar code found with 1 license type