# ☕ Serenatto Café

Sistema completo de cardápio digital com painel administrativo, desenvolvido em PHP com Orientação a Objetos.

---

## 📌 Sobre o projeto

O Serenatto Café é uma aplicação web que permite aos clientes visualizar o cardápio digital e ao administrador gerenciar os produtos do estabelecimento, incluindo cadastro, edição, exclusão e geração de relatório em PDF.

---

## 🚀 Funcionalidades

- 📋 Cardápio digital separado por Café e Almoço
- ➕ Cadastro de produtos com upload de imagem
- ✏️ Edição de produtos
- 🗑️ Exclusão de produtos
- 📄 Geração de relatório em PDF

---

## 🛠️ Tecnologias utilizadas

- PHP (OOP — Classes, namespaces, encapsulamento)
- MySQL + PDO
- Padrão Repository
- Dompdf (geração de PDF)
- Composer
- HTML, CSS e JavaScript

---

## ⚙️ Como rodar o projeto

### Pré-requisitos

- PHP 8+
- MySQL
- Composer
- Servidor local (XAMPP, Laragon, etc.)

### Passo a passo

1. Clone o repositório
```bash
git clone https://github.com/seu-usuario/PHP-studies.git
```

2. Acesse a pasta do projeto
```bash
cd PHP-studies/web-application/serenatto-cafe
```

3. Instale as dependências
```bash
composer install
```

4. Importe o banco de dados
```bash
mysql -u root -p < database.sql
```

5. Configure a conexão com o banco em `src/Conexao.php`
```php
self::$pdo = new PDO(
    'mysql:host=localhost;dbname=serenatto',
    'seu_usuario',
    'sua_senha'
);
```

6. Suba o servidor local e acesse o projeto no navegador

---

## 📁 Estrutura do projeto

```
serenatto-cafe/
├── src/
│   └── Conexao.php
├── Models/
│   └── Produto.php
├── Repository/
│   └── ProductRepository.php
├── css/
├── img/
├── js/
├── vendor/
├── index.php
├── admin.php
├── cadastrar-produto.php
├── editar-produto.php
├── excluir-produto.php
├── gerador-pdf.php
├── conteudo-pdf.php
├── database.sql
└── composer.json
```

---

## 👨‍💻 Autor

Desenvolvido por **Dereck** durante os estudos de PHP na Alura.
