<?php

namespace Src\Database;

use PDO;

class Conexao
{

    private static ?PDO $pdo = null;

    public static function getConexao(): PDO
    {
        if (self::$pdo === null) {
            self::$pdo = new PDO(
                'mysql:host=localhost;dbname=aluraplay',
                'exemple',
                'exemple123'
            );
        }
        return self::$pdo;
    }
}
