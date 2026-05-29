# 🎬 Controle de Séries (v2)

Um sistema completo desenvolvido em **Laravel** para gerenciar séries, temporadas e episódios assistidos. Este projeto foi criado como parte de um estudo aprofundado no framework Laravel, abordando práticas modernas de arquitetura, banco de dados e autenticação.

---

## 🚀 Funcionalidades Principal

- **🔐 Autenticação de Usuários**:
  - Registro de novos usuários com senhas criptografadas (`Hash::make`).
  - Login seguro com tratamento de erros.
  - Controle de acesso às rotas através de um Middleware personalizado (`Autenticador`), permitindo que visitantes apenas visualizem a lista de séries, enquanto operações de alteração/detalhe exigem login.

- **📺 CRUD Completo de Séries**:
  - Listagem, criação, edição e exclusão de séries.
  - Ordenação automática alfabética das séries em todas as consultas usando um **Global Scope** (`ordered`) no modelo Eloquent `Series`.

- **📅 Estrutura Organizacional Automatizada (Seasons & Episodes)**:
  - Ao criar uma nova série, você define o número de temporadas e a quantidade de episódios por temporada de uma só vez.
  - O cadastro desses registros é feito de forma transacional (`DB::transaction`) por meio do **Repository Pattern** (`EloquentSeriesRepository`), garantindo a integridade dos dados caso ocorra algum erro.

- **✅ Controle de Progresso (Episódios Assistidos)**:
  - Marcação de episódios assistidos de forma interativa.
  - Persistência eficiente usando o método `$season->push()`, que salva recursively o status dos episódios alterados de forma otimizada.
  - Contador de progresso em tempo real ("Assistidos / Total") calculado diretamente no banco de dados com `COUNT(*)` no SQL.

---

## 🛠️ Tecnologias Utilizadas

- **Backend**:
  - [Laravel 11+](https://laravel.com/)
  - PHP 8.2+
  - Eloquent ORM (Relacionamentos, Scopes e Transactions)
- **Frontend**:
  - [Blade Template Engine](https://laravel.com/docs/blade) (Componentização de Layout)
  - [Tailwind CSS v4](https://tailwindcss.com/) & [Bootstrap 5](https://getbootstrap.com/) (Integrados em conjunto no CSS)
  - [Vite](https://vite.dev/) (Empacotador de assets super rápido)
- **Banco de Dados**:
  - [MySQL](https://www.mysql.com/)

---

## 📂 Arquitetura do Projeto

Os arquivos chave que organizam a lógica desta aplicação são:

- **Controllers** (`app/Http/Controllers`):
  - [SeriesController](file:///c:/a.PHP/PHP-studies/laravel-journey/series-control-v2%20-%20Copia%20%282%29/app/Http/Controllers/SeriesController.php): Responsável pelas ações da série.
  - [SeasonController](file:///c:/a.PHP/PHP-studies/laravel-journey/series-control-v2%20-%20Copia%20%282%29/app/Http/Controllers/SeasonController.php): Efetua a listagem das temporadas.
  - [EpisodesController](file:///c:/a.PHP/PHP-studies/laravel-journey/series-control-v2%20-%20Copia%20%282%29/app/Http/Controllers/EpisodesController.php): Controla a listagem e a marcação de episódios como assistidos.
  - [LoginController](file:///c:/a.PHP/PHP-studies/laravel-journey/series-control-v2%20-%20Copia%20%282%29/app/Http/Controllers/LoginController.php) & [UsersController](file:///c:/a.PHP/PHP-studies/laravel-journey/series-control-v2%20-%20Copia%20%282%29/app/Http/Controllers/UsersController.php): Lógica de sessão e cadastro de novos usuários.
- **Modelos e Relacionamentos** (`app/Models`):
  - [Series](file:///c:/a.PHP/PHP-studies/laravel-journey/series-control-v2%20-%20Copia%20%282%29/app/Models/Series.php): Relacionamento `hasMany` com `Season`, contendo escopo global de ordenação.
  - [Season](file:///c:/a.PHP/PHP-studies/laravel-journey/series-control-v2%20-%20Copia%20%282%29/app/Models/Season.php): Relacionamento `belongsTo` com `Series` e `hasMany` com `Episode`.
  - [Episode](file:///c:/a.PHP/PHP-studies/laravel-journey/series-control-v2%20-%20Copia%20%282%29/app/Models/Episode.php): Relacionamento `belongsTo` com `Season` e propriedade `watched` (booleano).
- **Camada de Repositórios** (`app/Repositories`):
  - [EloquentSeriesRepository](file:///c:/a.PHP/PHP-studies/laravel-journey/series-control-v2%20-%20Copia%20%282%29/app/Repositories/EloquentSeriesRepository.php): Encapsula a lógica de negócio transacional ao adicionar uma série com múltiplas temporadas e episódios de uma única vez.
- **Middlewares** (`app/Http/Middleware`):
  - [Autenticador](file:///c:/a.PHP/PHP-studies/laravel-journey/series-control-v2%20-%20Copia%20%282%29/app/Http/Middleware/Autenticador.php): Verifica se o usuário está logado antes de liberar as rotas de gerenciamento.

---

## 🔧 Instruções para Instalação e Execução

Siga os passos abaixo para configurar o projeto na sua máquina local:

### 1. Clonar o repositório
```bash
git clone <url-do-seu-repositorio>
cd series-control-v2
```

### 2. Instalar dependências do Composer (PHP)
```bash
composer install
```

### 3. Instalar dependências do NPM (Node/CSS/JS)
```bash
npm install
```

### 4. Configurar Variáveis de Ambiente
Duplique o arquivo `.env.example` e renomeie para `.env`:
```bash
cp .env.example .env
```
Abra o arquivo `.env` e configure sua conexão com o banco de dados MySQL:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=controle_series
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

*(Obs: Certifique-se de que o banco de dados `controle_series` já existe no seu gerenciador MySQL.)*

### 5. Gerar a chave criptográfica da aplicação
```bash
php artisan key:generate
```

### 6. Executar as Migrations
Crie a estrutura de tabelas no banco de dados executando as migrações:
```bash
php artisan migrate
```

### 7. Inicializar os Servidores

Em um terminal, execute o servidor de desenvolvimento PHP do Laravel:
```bash
php artisan serve
```

Em outro terminal, execute o compilador de assets (Vite):
```bash
npm run dev
```

Agora, abra o seu navegador e acesse: `http://localhost:8000` (ou a porta indicada pelo terminal).

---

## 🔒 Licença

Este projeto é de uso educacional e acadêmico. Fique à vontade para utilizá-lo como base de estudo! 🚀
