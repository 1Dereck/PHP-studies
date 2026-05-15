<?php

use Src\Database\Conexao;

require_once __DIR__ . '/vendor/autoload.php';
$pdo = Conexao::getConexao();

$email = $argv[1];
$password = $argv[2];
$hash = password_hash($password, PASSWORD_ARGON2ID);

$sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':email', $email);
$stmt->bindValue(':password', $hash);
$stmt->execute();
