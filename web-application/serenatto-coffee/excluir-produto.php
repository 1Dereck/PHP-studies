<?php

require "vendor/autoload.php";

use Src\Conexao;
use Repository\ProductRepository;

$pdo = Conexao::getConexao();

$produtoRepositorio = new ProductRepository($pdo);
$produtoRepositorio->deletar($_POST["id"]);

header("Location: admin.php");
