<?php

namespace Repository;

use Exception\MoreThanOneException;
use Exception\NotFoundException;
use Model\SessionUser;
use PDO;


class SessionRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    public function addSessionPlayer($pseudo, $code){
        $query = 'INSERT INTO SESSION (pseudo, code) VALUES (:pseudo, :code)';
        $statement = $this->connexion->prepare($query);
        $statement->execute([
            'pseudo' => $pseudo,
            'code' => $code
        ]);
    }

    public function deleteSession(){
        $query = 'DELETE FROM SESSION';
        $statement = $this->connexion->prepare($query);
        $statement->execute();
    }

    public function getRanking() :  array{
        $query = 'SELECT * FROM SESSION ORDER BY SCORE DESC';
        $statement = $this->connexion->prepare($query);
        $statement->execute();
        $sessionUsers = [];
        while ($data = $statement->fetch(PDO::FETCH_ASSOC)) {
            $sessionUsers[] = new SessionUser($data);
        }
        return $sessionUsers;
    }

    public function deleteUserById($id): void
    {
        //On supprime un user avec son id
        $query = 'DELETE FROM SESSION WHERE SESSION_USER_ID = :id';
        $statement = $this->connexion->prepare($query);
        $statement->execute(['id' => $id]);

        //Si la requête ne rend rien ça veut dire qu'il n'y a aucun utilisateurs avec cette id
        if ($statement->rowCount() === 0) {
            throw new NotFoundException('Aucun USER trouvé');
        }
    }

}