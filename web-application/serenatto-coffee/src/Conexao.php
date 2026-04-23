<?php

namespace Src;

use PDO;

class Conexao
{

    private static ?PDO $pdo = null;

    public static function getConexao(): PDO
    {
        if (self::$pdo === null) {
            self::$pdo = new PDO(
                'mysql:host=localhost;dbname=serenatto',
                'exemple',
                'exemple123'
            );
        }
        return self::$pdo;
    }
}
