Requisitos:
XAMPP instalado (Apache)
MySQL instalado

1. **Clone o repositório:**
   git clone https://github.com/Mateussouza011/cadastroPessoa.git

2. **Copie o projeto para o diretório do XAMPP:**
    C:\xampp\htdocs\

3. **Instale as dependências:** (apague o arquivo composer.lock caso ocorra erro na execução do composer)
    
    cd C:\xampp\htdocs\cadastroPessoa
    composer install

4. **Crie o banco de dados mySQL:**

   - Acesse o mySQL com um usuario 'root' e a senha 'password'
    abra o script localizado no cadatroPessoa/sistema_pessoasDB.sql no mySql ou abra e copie o script na Query do mySQL

5. **Configurando o php.ini**
    -Mova e substitua o arquivo php.ini disponibilizado na pasta C:\xampp\htdocs\cadastroPessoa para a pasta C:\xampp\php 

### Execução

1. **Inicie o XAMPP:**

   - Abra o painel de controle do XAMPP e inicie os módulos Apache 

2. **Acesse a aplicação:**

   Abra o navegador e acesse `http://localhost/cadastroPessoa`.

3. **Login na aplicação:**

-Utilize o login 
    .login: user
    .senha: user
para ter a visão do usuario padrão, ou:
    .login:admin
    .senha:admin
para ter a visão do administrador do sistema.

