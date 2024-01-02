<?php

namespace App\Repository;

use App\Exception\CannotCreateException;
use App\Exception\EmptyFieldException;
use App\Exception\MoreThanOneException;
use App\Exception\NotFoundException;
use App\Exception\PasswordVerificationException;
use App\Model\User;

class SpartiatesRepository extends AbstractRepository
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll() :  array{
        $query = 'SELECT * FROM USER ORDER BY USER.SCORE DESC';
        $statement = $this->connexion->prepare($query);
        $statement->execute();

        if ($statement->rowCount() === 0) {
            throw new NotFoundException('Aucun untilisateur n\'a été trouvé ');
        }

        //on créer un tableau de User contenant toutes les données
        $arraySQL = $statement->fetchAll();
        $arrayUser = array();

        /* on récupére le résultat de la requête SQL et on le met dans un tableau d'User'*/
        for ($i = 0; $i < sizeof($arraySQL); $i++) {
            $user = new User($arraySQL[$i]);
            $arrayUser[] = $user;
        }

        return $arrayUser;
    }
}
