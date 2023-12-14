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
                getenv('DB_HOCKEY_DSN'),
                getenv('DB_HOCKEY_USER'),
                getenv('DB_HOCKEY_PASSWORD')
            );
        }
        return self::$instance;
    }
}
?>