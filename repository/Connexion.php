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
                'mysql:host=mysql-jeuspartiates.alwaysdata.net;dbname=jeuspartiates_bd',
                '340307',
                'Sparte300'
//                getenv('DB_DSN'),
//                getenv('DB_USER'),
//                getenv('DB_PASSWORD')
            );
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }
        return self::$instance;
    }
}
?>