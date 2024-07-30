

## Visão Geral

Este é um sistema de gestão de produtos desenvolvido com Laravel no backend e Vue.js no frontend. Ele inclui funcionalidades de CRUD para produtos e categorias, além de um sistema de autenticação utilizando JWT.

## Tecnologias Utilizadas

- **Backend:** Laravel 9.0 ou superior com PHP 8.0 ou superior
- **Frontend:** Vue.js 3 com TypeScript, Vite como bundler
- **Banco de Dados:** MySQL 8.0
- **Servidor de Desenvolvimento:** XAMPP (opcional, mas recomendado)

## Configuração do Ambiente de Desenvolvimento

### Requisitos

- PHP 8.0 ou superior
- Composer
- Node.js e npm/yarn
- MySQL
- XAMPP (opcional, mas recomendado)

### Instalação

1. Clone o repositório:
   
   ```bash
   git clone https://github.com/MiguelAmoedo/api-produtos-laravel
   cd nome-do-repositorio
   ```

2. Configure o backend Laravel:
   
   ```bash
   cd backend
   composer install
   cp .env.example .env
   php artisan key:generate
   ```

3. Configure o banco de dados no arquivo `.env` ou COPIE: `.env.example`!:

   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=dev
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. Apague o cache das configurações:
   
   ```bash
   php artisan config:cache
   ```

5. Crie a tabela necessária ou aplique o comando abaixo:
   
   ```bash
   php artisan make:migration add_dev_to_products_table
   ```

6. Execute as migrações:
   
   ```bash
   php artisan migrate
   ```

7. Inicie o servidor:
   
   ```bash
   npm start
   ```

## Rotas da API

A API está disponível na URL: [http://127.0.0.1:8000/api/](http://127.0.0.1:8000/api/)

### Categorias

- **Cadastrar Categoria:** `POST /categories`
  - Cadastra uma nova categoria.
  - Exemplo de request:
    ```json
    {
      "name": "xbox"
    }
    ```
  - Exemplo de response:
    ```json
    {
      "name": "xbox",
      "updated_at": "2024-07-30T14:49:19.000000Z",
      "created_at": "2024-07-30T14:49:19.000000Z",
      "id": 1
    }
    ```

### Produtos

- **Listar Produtos:** `GET /products`
  - Lista os produtos com paginação.

- **Cadastrar Produto:** `POST /products`
  - Cadastra um novo produto.
  - Exemplo de request:
    ```json
    {
      "name": "produto1",
      "description": "produto top",
      "price": "123",
      "expiry_date": "2020-10-10",
      "image": "url",
      "category_id": 1
    }
    ```
  - Exemplo de response:
    ```json
    {
      "product": {
        "name": "produto1",
        "description": "produto top",
        "price": "123",
        "expiry_date": "2020-10-10",
        "image": "url",
        "category_id": 1,
        "updated_at": "2024-07-30T14:53:10.000000Z",
        "created_at": "2024-07-30T14:53:10.000000Z",
        "id": 1,
        "category": {
          "id": 1,
          "name": "xbox",
          "created_at": "2024-07-30T14:49:19.000000Z",
          "updated_at": "2024-07-30T14:49:19.000000Z"
        }
      }
    }
    ```

- **Atualizar Produto:** `PUT /products/{id}`
  - Atualiza um produto existente.

- **Deletar Produto:** `DELETE /products/{id}`
  - Deleta um produto existente.

### Sistema de Autenticação (JWT)

Utilizamos JWT para autenticação de usuários. As rotas são as seguintes:

- **Registrar:** `POST /register`
  - Registra um novo usuário.
  - Exemplo de request:
    ```json
    {
      "name": "marcos",
      "email": "marcos@email.com",
      "password": "password123",
      "password_confirmation": "password123"
    }
    ```
  - Exemplo de response:
    ```json
    {
      "message": "Usuário cadastrado com sucesso.",
      "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNzIyMzUzMTUzLCJleHAiOjE3MjIzNTY3NTMsIm5iZiI6MTcyMjM1MzE1MywianRpIjoicWJ1QVJnckVJVVVFdG9ZcyIsInN1YiI6IjEiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.JetS6cDWfoeztfoVe2NmCYPRgj4KJTKiKBPFKvtBW3M",
      "user": {
        "id": 1,
        "name": "marcos",
        "email": "marcos@email.com",
        "created_at": "2024-07-30T14:53:10.000000Z",
        "updated_at": "2024-07-30T14:53:10.000000Z"
      }
    }
    ```

- **Login:** `POST /login`
  - Autentica um usuário e retorna um token JWT.
  - Exemplo de request:
    ```json
    {
      "email": "marcos@email.com",
      "password": "password123"
    }
    ```
  - Exemplo de response:
    ```json
    {
      "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNzIyMzUzMTUzLCJleHAiOjE3MjIzNTY3NTMsIm5iZiI6MTcyMjM1MzE1MywianRpIjoicWJ1QVJnckVJVVVFdG9ZcyIsInN1YiI6IjEiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.JetS6cDWfoeztfoVe2NmCYPRgj4KJTKiKBPFKvtBW3M"
    }
    ```

- **Logout:** `POST /logout`
  - Realiza o logout do usuário autenticado (requer token JWT).

- **Usuário Autenticado:** `GET /user`
  - Retorna os dados do usuário autenticado (requer token JWT).

## Considerações Finais

Este projeto foi desenvolvido como um desafio, para proporcionar um sistema de autenticação seguro utilizando JWT. Sinta-se à vontade para contribuir e melhorar este projeto.

---

Este README cobre a configuração do ambiente de desenvolvimento, instalação das dependências, execução do servidor e as principais rotas da API, incluindo o sistema de autenticação JWT.
