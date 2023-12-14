<?php

namespace App\Repository;
use PDO;

abstract class AbstractRepository
{
    protected PDO $connexion ;
    public function __construct()
    {
        putenv("DB_HOCKEY_DSN=mysql:host=mysql-jeuspartiates.alwaysdata.net;dbname=jeuspartiates_bd");
        putenv("DB_HOCKEY_USER=340307");
        putenv("DB_HOCKEY_PASSWORD=Sparte300");
        $this->connexion = Connexion::getInstance();
    }
}