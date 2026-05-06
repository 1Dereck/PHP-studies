<?php

namespace App\Infrastructure;
use App\Infrastructure\ClassePai;
use PDO;

class PdoFamiliaRepository
{
    private PDO $connection;

    public function __construct(PDO $connection) {
        $this->connection = $connection;
    }

    public function salvar(ClassePai $membro): bool {
        $sqlAdd = "INSERT INTO classeFamilia (nome, altura) VALUEs (:nome,:altura);";
        $declaracao = $this->connection->prepare(($sqlAdd));

        // Usamos os métodos de classe para pegar os dados
        $declaracao->bindValue(":nome", $membro->getNome());
        $declaracao->bindValue(":altura", $membro->getAltura());
        
        return $declaracao->execute();
    }
}
