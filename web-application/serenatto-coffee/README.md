# ☕ Serenatto Café

Sistema completo de cardápio digital com painel administrativo, desenvolvido em PHP utilizando Orientação a Objetos e integração com MySQL.

---

## 📌 Sobre o projeto

O Serenatto Café é uma aplicação web que permite aos clientes visualizar o cardápio (dividido entre Café e Almoço) e oferece ao administrador uma interface para gerenciar produtos, incluindo cadastro, edição, exclusão e geração de relatórios em PDF.

---

## 🚀 Funcionalidades

- 📋 Cardápio digital por categorias (Café e Almoço)
- ➕ Cadastro de produtos com upload de imagem
- ✏️ Edição de produtos
- 🗑️ Exclusão de produtos
- 📄 Geração de relatórios em PDF

---

## 🛠️ Tecnologias utilizadas

- PHP 8+ (PDO, namespaces, encapsulamento)
- MySQL
- Padrão Repository
- Composer (Dompdf para PDF)
- HTML, CSS e JavaScript

---

## ⚙️ Como rodar o projeto

### Pré-requisitos

- PHP 8+
- MySQL
- Composer
- Servidor local (XAMPP, Laragon ou similar)

### Passo a passo

1. Clone o repositório  
   git clone git clone https://github.com/1Dereck/PHP-studies.git 

2. Acesse a pasta do projeto  
   cd PHP-studies/web-application/serenatto-cafe  

3. Instale as dependências  
   composer install  

4. Crie e importe o banco de dados  

⚠️ Atenção: Recomenda-se utilizar o MySQL Workbench para importar o arquivo `database.sql`, pois a importação via terminal pode causar problemas de encoding (acentuação).

No Workbench: File > Open SQL Script → selecione `database.sql` → execute.

Alternativa via terminal:  
mysql -u root -p --default-character-set=utf8mb4 < database.sql  

5. Configure a conexão  

No arquivo `src/Conexao.php`:

self::$pdo = new PDO(
    'mysql:host=localhost;dbname=serenatto',
    'seu_usuario',
    'sua_senha'
);

6. Execute o projeto  

Acesse no navegador:  
http://localhost/serenatto-cafe/index.php  

---

## 📁 Estrutura do projeto

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

---

## 👨‍💻 Autor

Desenvolvido por **Dereck** durante os estudos de PHP.
