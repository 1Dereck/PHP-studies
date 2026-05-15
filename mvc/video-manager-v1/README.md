# Video Manager

Aplicação web de gerenciamento de vídeos construída em PHP puro utilizando a arquitetura MVC. Permite cadastrar, editar e excluir vídeos a partir de URLs de embed do YouTube.

## 🚀 Tecnologias

- **PHP 8+**
- **MySQL**
- **PDO** (PHP Data Objects) para persistência de dados
- **Composer** (PSR-4 autoload)
- **HTML5 e CSS3** para a interface do usuário

## 📂 Estrutura do Projeto

```text
video-manager/
├── config/
│   └── routes.php
├── pages/
│   └── login.html
├── public/
│   ├── css/
│   ├── img/
│   └── index.php
├── src/
│   ├── Controller/
│   │   ├── Controller.php
│   │   ├── DeleteVideoController.php
│   │   ├── EditVideoController.php
│   │   ├── Error404Controller.php
│   │   ├── NewVideoController.php
│   │   ├── VideoFormController.php
│   │   └── VideoListController.php
│   ├── Database/
│   │   └── Conexao.php
│   ├── Models/
│   │   └── Video.php
│   └── Repository/
│       └── VideoRepository.php
├── vendor/
├── views/
│   ├── fim-html.php
│   ├── inicio-html.php
│   ├── video-form.php
│   └── video-list.php
├── composer.json
├── composer.lock
└── database.sql
```

## ⚙️ Como rodar localmente

### Pré-requisitos
- PHP 8+
- MySQL (Recomendado: MySQL Workbench)
- Composer

### Instalação e Configuração do Banco

1. **Clone o repositório:**
   ```bash
   git clone [https://github.com/seu-usuario/video-manager.git](https://github.com/seu-usuario/video-manager.git)
   cd video-manager
   ```

2. **Instale as dependências:**
   ```bash
   composer install
   ```

3. **Crie o Banco de Dados (Evitando erros de acentuação):**
   Para garantir que caracteres especiais e acentos sejam exibidos corretamente, recomenda-se o uso do **MySQL Workbench** para criar o schema com o conjunto de caracteres `utf8mb4`.
   
   Execute o seguinte comando no seu cliente SQL:
   ```sql
   CREATE DATABASE IF NOT EXISTS aluraplay 
       CHARACTER SET utf8mb4 
       COLLATE utf8mb4_unicode_ci;

   USE aluraplay;

   -- Importe as tabelas do arquivo database.sql ou execute o script de criação
   ```

4. **Configure a conexão:**
   Edite o arquivo `src/Database/Conexao.php` com suas credenciais locais e certifique-se de que o charset está definido como `utf8mb4` no DSN do PDO.

5. **Suba o servidor:**
   ```bash
   php -S localhost:8080 -t public/
   ```

6. **Acesse:** `http://localhost:8080` no seu navegador.

## 🎯 Funcionalidades

- Listagem de vídeos cadastrados.
- Cadastro de um novo vídeo via URL de embed.
- Edição de um vídeo existente.
- Exclusão de vídeos da plataforma.

## 🧠 Conceitos aplicados

- **Arquitetura MVC** (Model, View, Controller) para separação de responsabilidades.
- **Roteamento HTTP manual** com separação por método (GET/POST).
- **Repository Pattern** isolando a lógica de banco de dados com PDO.
- **Interfaces PHP** para firmar contratos entre os controllers.
- **Validação e sanitização** de dados com `filter_input` e `filter_var`.
- **Autoload PSR-4** gerenciado via Composer.

---
*Desenvolvido por Dereck Felipe Maciel Pereira*
```
