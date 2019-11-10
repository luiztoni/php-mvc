# Demo App PHP 7
 📖 Conceitos demonstrados:

 * OO Design
 * MVC
 * Front Controller
 * Service Layer
 * Repository Pattern
 * Autenticação Básica
 * Token de validação de acesso
 * Cookies e Sessões
 * Form Method Spoofing
 * Encriptação de senha
 * Conexão PDO 
 * Upload de Imagem
 * PHP Partial HTML

## Instruções básicas

 1. Instalar e habilitar PHP 7.x com a extensão sqlite PDO  no arquivo php.ini
 2. Iniciar o servidor de desenvolvimento no diretório php-mvc: *php -S localhost:8080*

### Rotas:

| Verbo HTTP | URI                     | Descrição            |
| ---------- |:-----------------------:| --------------------:|
| GET        | /products/index         | listar produtos      |
| GET        | /products/show/:id      | mostrar produto      |
| POST       | /products/store         | criar  produto       |
| PUT        | /products/update/:id    | atualizar produto    |
| DELETE     | /products/destroy/:id   | deletar produto      |
| GET        | /users/signup           | criar usuário        |
| POST       | /users/register         | criar usuário        |
| GET        | /users/signin           | autenticar usuário   |
| POST       | /users/login            | autenticar usuário   |
| POST       | /users/logout           | deslogar usuário     |
| POST       | /users/image            | alterar imagem       |
| POST       | /users/upload           | efetuar upload       |


#### License MIT Copyright (c) 2018 Luiz Toni
