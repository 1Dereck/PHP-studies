# 🎬 Controle de Séries v3 — Hybrid & RESTful API

[![Laravel Version](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-8.3-777BB4?style=for-the-badge&logo=php)](https://php.net)
[![Pest Test](https://img.shields.io/badge/Tests-Pest-0196CA?style=for-the-badge&logo=pest)](https://pestphp.com)
[![TailwindCSS](https://img.shields.io/badge/Tailwind-v4.0-38B2AC?style=for-the-badge&logo=tailwind-css)](https://tailwindcss.com)

Um sistema completo de controle e gerenciamento de séries, temporadas e episódios assistidos. Desenvolvido em **Laravel 13**, o projeto oferece uma experiência híbrida robusta: uma interface web amigável com **Blade** e **Tailwind CSS v4**, integrada com uma **API RESTful** autenticada via **Laravel Sanctum**, além de processamento de **filas em background** para envio assíncrono de e-mails e cobertura de testes automatizados com **Pest PHP**.

Este projeto foi construído para servir de portfólio público no GitHub, demonstrando boas práticas de arquitetura e uso avançado do ecossistema Laravel.

---

## 🕒 Histórico de Evolução do Projeto

Este projeto passou por três grandes etapas de desenvolvimento, refletindo meu aprendizado em PHP e no ecossistema Laravel:

1. **v1 (MVC Tradicional):** Sistema básico utilizando a arquitetura MVC do Laravel, focado no CRUD com Blade, rotas web tradicionais e persistência simples.
2. **v2 (Eventos e Performance):** Introdução de conceitos assíncronos, Jobs, Filas (`Queue`), disparo de e-mails via Mailtrap e implementação do _Repository Pattern_ com transações de banco de dados (`DB::transaction`).
3. **v3 (API REST & Sanctum — Esta versão):** Evolução para uma arquitetura híbrida com a criação de uma API REST completa, autenticação moderna e _stateless_ com Laravel Sanctum (Bearer Tokens), controle de permissões (`abilities`) e testes automatizados com Pest PHP.

---

## 🛠️ Tecnologias e Ferramentas

- **Backend:** PHP 8.3+ & Laravel 13.x
- **Autenticação:** Laravel Sanctum (Token-based/Stateless)
- **Frontend:** Laravel Blade, Vite, Tailwind CSS v4
- **Banco de Dados:** MySQL / SQLite
- **Fila/Mensageria:** Database Queue Driver
- **Testes Automatizados:** Pest PHP
- **Simulador de E-mail:** Mailtrap.io
- **Cliente HTTP/Testes de API:** Postman

---

## 🚀 Principais Recursos

- **🔐 Autenticação Stateless (API):** Login via API REST que retorna um Bearer Token (Sanctum) e controle de habilidades de token (`abilities` como `is_admin`) para restrição de rotas.
- **🖥️ Interface Web:** CRUD completo e responsivo de Séries, Temporadas e marcação em lote de Episódios assistidos.
- **🎨 UI/UX Moderna e Interativa:** Design premium utilizando Tailwind CSS v4 e Alpine.js, com uso de glassmorphism, animações suaves e modais dinâmicos para operações de CRUD (Visualizar, Editar, Excluir).
- **👀 Status Visual de Episódios:** Interface aprimorada na listagem de episódios para identificação clara e intuitiva de episódios assistidos versus pendentes.
- **⚡ Criação Transacional:** O cadastro de séries cria automaticamente as temporadas e episódios de forma atômica no banco de dados, utilizando o **Repository Pattern** envolvido por `DB::transaction`.
- **📫 E-mails Assíncronos:** O cadastro de novas séries dispara um evento que enfileira (`Queue`) o envio de e-mails em segundo plano, mantendo o tempo de resposta do usuário extremamente baixo.
- **📈 Gerenciamento de Progresso:** Controle individual ou coletivo de episódios assistidos (com feedbacks em tempo real de contagem na Web e rota `PATCH` na API).

---

## ⚙️ Pré-requisitos para Instalação

Antes de começar, certifique-se de ter instalado em sua máquina:

- **PHP 8.3** ou superior
- **Composer** (gerenciador de dependências PHP)
- **Node.js 20+** e **NPM**
- **MySQL** ou outro SGBD compatível
- **Git**
- Uma conta no **[Mailtrap](https://mailtrap.io/)** (gratuito) para testar e inspecionar os e-mails enviados.

---

## 💻 Passo a Passo para Configuração

### 1. Clonar o Repositório

```bash
git clone https://github.com/seu-usuario/seu-repositorio.git
cd seu-repositorio
```

### 2. Instalar Dependências do PHP

```bash
composer install
```

### 3. Instalar Dependências do Frontend

```bash
npm install
```

### 4. Configurar Variáveis de Ambiente (`.env`)

Copie o arquivo de exemplo para o seu arquivo oficial `.env`:

```bash
cp .env.example .env
```

Abra o arquivo `.env` gerado na raiz e configure as seções abaixo:

#### Banco de Dados (Exemplo com MySQL):

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_seu_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

_(Certifique-se de que o banco de dados especificado em `DB_DATABASE` foi criado no seu servidor)._

#### E-mail (Integração com Mailtrap):

O projeto envia um e-mail de notificação ao cadastrar novas séries. Para simular esse envio localmente:

1. Acesse o site do **[Mailtrap](https://mailtrap.io/)** e crie uma conta gratuita.
2. Acesse **Email Testing** -> **Inboxes** -> Clique na sua Inbox padrão.
3. Na aba **SMTP Settings**, selecione **Laravel** no menu dropdown de integração de código.
4. Copie as credenciais fornecidas e atualize o seu `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=seu_username_do_mailtrap
MAIL_PASSWORD=sua_senha_do_mailtrap
MAIL_FROM_ADDRESS="noreply@seriescontrol.com"
MAIL_FROM_NAME="Controle de Séries"
```

#### Configuração das Filas (Queue Connection):

Para que o Laravel direcione as notificações para processamento em fila no banco de dados, verifique a variável:

```env
QUEUE_CONNECTION=database
```

### 5. Gerar a Chave Única da Aplicação

```bash
php artisan key:generate
```

### 6. Base de Dados Pré-configurada (Dump)

Para que você tenha uma base sólida para se basear e testar, disponibilizamos um arquivo de dump do banco de dados com a estrutura pronta. Ele está localizado em: `database/dumps/controle_series.sql`.

Você pode importar esse arquivo no seu banco de dados (exemplo com MySQL):

```bash
mysql -u seu_usuario -p nome_do_seu_banco < database/dumps/controle_series.sql
```

### 7. Executar as Migrações (Alternativa)

Caso não queira utilizar o dump acima e prefira criar as tabelas vazias do zero, execute o comando de migração padrão do Laravel:

```bash
php artisan migrate
```

---

## ▶️ Como Executar a Aplicação

Para o funcionamento completo de todas as engrenagens do projeto (Servidor Web, compilação de estilização CSS e processamento de e-mails em background), você precisará rodar os seguintes comandos em terminais separados:

### Terminal 1: Servidor Local do Laravel

```bash
php artisan serve
```

> A aplicação estará acessível em: [http://localhost:8000](http://localhost:8000)

### Terminal 2: Compilação e Hot Reload do Frontend (Vite)

```bash
npm run dev
```

> Responsável por monitorar e compilar as folhas de estilo do Tailwind CSS v4 em tempo real.

### Terminal 3: Processador de Filas (Queue Worker)

```bash
php artisan queue:work
```

> **Essencial** para escutar a fila no banco de dados e processar o envio assíncrono dos e-mails à caixa de testes do Mailtrap.

---

💡 **Dica de Produtividade (Executar tudo com um único comando):**
O arquivo `composer.json` deste projeto já conta com o pacote `concurrently` configurado. Caso queira iniciar o servidor, o compilador Vite, o processador de filas e a visualização de logs juntos em um só terminal, basta executar:

```bash
composer dev
```

---

## 🧪 Testando as Rotas da API

Para facilitar os testes das rotas da aplicação, disponibilizei uma coleção pronta do Postman. Assim, você não precisa configurar requisição por requisição manualmente.

### Como importar:

1. Certifique-se de ter o [Postman](https://www.postman.com/) instalado.
2. Abra o Postman e, no canto superior esquerdo, clique no botão **Import**.
3. Selecione o arquivo que está na raiz deste projeto em: `docs/api_postman_collection.json`.
4. Pronto! Todas as rotas (Buscar, Criar, Atualizar, Remover) estarão configuradas e prontas para uso.

> **Observação sobre autenticação na API:**
> As rotas da API (exceto a de Login) são protegidas. Faça uma requisição para a rota `POST /api/login` enviando os dados de um usuário existente, copie o token retornado e configure-o como **Bearer Token** na aba **Authorization** da pasta ou das requisições no Postman para obter acesso autorizado.

---

## 🚦 Executando Testes Automatizados

O projeto utiliza a suíte de testes do **Pest PHP**. Para rodar todas as validações e garantir que as regras de negócio estão íntegras, execute:

```bash
php artisan test
```

---

## 📂 Estrutura e Arquitetura do Projeto

O sistema foi arquitetado visando a modularidade e facilidade de manutenção:

- **`app/Repositories`**: Padrão repository com `EloquentSeriesRepository` encapsulando a transação de banco de dados (`DB::transaction`) na criação coordenada de séries, temporadas e episódios.
- **`app/Events` & `app/Listeners`**: Abstração de eventos para acionar gatilhos de forma desacoplada (como registrar Logs e disparar e-mails em segundo plano).
- **`app/Mail`**: Modelagem estruturada dos e-mails de aviso utilizando templates Blade dinâmicos.
- **`app/Http/Controllers/Api`**: Controladores dedicados a prover respostas padronizadas em JSON para consumo de clientes externos.

---

## 🔒 Licença

Este projeto é livre para uso educacional e construção de portfólio. Sinta-se à vontade para realizar um fork, sugerir melhorias ou utilizá-lo em seus estudos! 🚀
