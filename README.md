

# Sistema de Gestão de Produtos

## Visão Geral

Este é um sistema de gestão de produtos desenvolvido com Laravel no backend e Vue.js no frontend. Ele inclui funcionalidades de CRUD para produtos e categorias, além de um sistema de autenticação utilizando JWT.

## Tecnologias Utilizadas

- **Backend:** Laravel 9.0 ou superior com PHP 8.0 ou superior
- **Frontend:** Vue.js 3 com TypeScript, Vite como bundler
- **Banco de Dados:** MySQL 8.0
- **Servidor de Desenvolvimento:** XAMPP

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
   git clone [https://github.com/seu-usuario/nome-do-repositorio.git](https://github.com/MiguelAmoedo/api-produtos-laravel.git)
   cd nome-do-repositorio
   ```

2. Configure o backend Laravel:
   ```bash
   cd backend
   composer install
   cp .env.example .env
   php artisan key:generate
   ```

3. Configure o banco de dados no arquivo `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=dev
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. Execute as migrações:
   ```bash
   php artisan migrate
   ```

5. Inicie o servidor:
   ```bash
   php artisan serve
   ```



## Rotas da API

A API está disponível na URL: `http://127.0.0.1:8000/api/`

### Produtos

- **Listar Produtos:** `GET /products`
  - Lista os produtos com paginação.

- **Cadastrar Produto:** `POST /products`
  - Cadastra um novo produto.

- **Atualizar Produto:** `PUT /products/{id}`
  - Atualiza um produto existente.

- **Deletar Produto:** `DELETE /products/{id}`
  - Deleta um produto existente.

### Categorias

- **Cadastrar Categoria:** `POST /categories`
  - Cadastra uma nova categoria.

### Sistema de Autenticação (JWT)

Utilizamos JWT para autenticação de usuários. As rotas são as seguintes:

- **Registrar:** `POST /register`
  - Registra um novo usuário.

- **Login:** `POST /login`
  - Autentica um usuário e retorna um token JWT.

- **Logout:** `POST /logout`
  - Realiza o logout do usuário autenticado (requer token JWT).

- **Usuário Autenticado:** `GET /user`
  - Retorna os dados do usuário autenticado (requer token JWT).

## Considerações Finais

Este projeto foi desenvolvido para facilitar a gestão de produtos e categorias, além de proporcionar um sistema de autenticação seguro utilizando JWT. Sinta-se à vontade para contribuir e melhorar este projeto.

## Licença

Este projeto está licenciado sob a [MIT License](LICENSE).

---

Este README cobre a configuração do ambiente de desenvolvimento, instalação das dependências, execução do servidor e as principais rotas da API, incluindo o sistema de autenticação JWT.
