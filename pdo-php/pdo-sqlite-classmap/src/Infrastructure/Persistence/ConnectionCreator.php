<?php

namespace App\Infrastructure\Persistence;

use PDO;

class ConnectionCreator
{
    public static function createConnection(): PDO {
        $bancoBase = __DIR__ ."/../../../banco.sqlite";

        $pdo = new PDO("sqlite:" . $bancoBase);
        
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }
}
