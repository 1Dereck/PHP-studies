
// Criando Tabela de Banco de Dados

<?php

require_once 'vendor/autoload.php';
use App\Database\CriandoConexao;

$pdo = CriandoConexao::conexao();

$pdo->exec("
    CREATE TABLE IF NOT EXISTS restaurante (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    prato TEXTO,
    bebida TEXTO
    );
");

echo "Tabela criada\n";
