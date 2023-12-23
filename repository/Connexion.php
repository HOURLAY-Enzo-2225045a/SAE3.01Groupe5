<?php

namespace App\Repository;

use PDO;

class Connexion
{
    private static ?PDO $instance = null;

    public static function getInstance(): PDO
    {
        if (self::$instance == null) {

            self::$instance = new \PDO(
                'mysql:host=localhost;dbname=jeuspartiates_bd',
                'root',
//                getenv('DB_DSN'),
//                getenv('DB_USER'),
//                getenv('DB_PASSWORD')
            );
        }
        return self::$instance;
    }
}
?>