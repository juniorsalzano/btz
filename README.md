# BTZ

## Descrição
Este é um projeto de teste criado para avaliar conhecimentos em desenvolvimento web. 
É um projeto simples, desenvolvido do zero pelo autor com o objetivo de validar 
boas práticas.

## Autor
- Nome: Edson Roberto Salzano Junior

## Finalidade
A finalidade deste projeto é testar conhecimentos em desenvolvimento web, 
incluindo a criação de uma aplicação simples com autenticação de usuários, 
edição de perfis e listagem de usuários.

## Requisitos
- PHP 7.4 ou superior
- Composer
- MySQL

## Instalação
1. Clone o repositório:
   ```sh
   git clone https://github.com/juniorsalzano/btz.git
   cd bkz

2. Instale as dependências do projeto:
Executar o comando: composer install

3. Crie o arquivo .env a partir do exemplo:
cp .env.example .env

4. Configure o arquivo .env com as informações do seu banco de dados MySQL.

5. Execute o script SQL que está na pasta sql para criar as tabelas necessárias no banco de dados.

6. Aponte o servidor web para a pasta public do projeto.

## Uso
1. Inicie o servidor web apontando para a pasta public.
2. Acesse a aplicação através do navegador.
3. Faça login com o usuário administrador:
  - Email: admin@example.com
  - Senha: admin

## Estrutura do Projeto
* src: Contém os arquivos de código-fonte da aplicação.
* public: Contém os arquivos públicos acessíveis pelo navegador.
* sql: Contém o script SQL para criação das tabelas no banco de dados.
* vendor: Contém as dependências do Composer.

## Licença
* Este projeto é de uso livre para fins de estudo e aprendizado.