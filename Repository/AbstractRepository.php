<?php

namespace App\Repository;
use PDO;

abstract class AbstractRepository
{
    protected PDO $connexion ;
    public function __construct()
    {
        putenv("DB_DSN=mysql:host=mysql-rbb.alwaysdata.net;dbname=rbb_jeuxhockey");
        putenv("DB_USER=rbb");
        putenv("DB_PASSWORD=RayaneBD20");
        $this->connexion = Connexion::getInstance();
    }
}