<?php

namespace Repository;

use Exception\MoreThanOneException;


class CodesRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    public function checkSessionCode($code)
    {
        //on select tout les Users avec le même pseudo et password
        $query = 'SELECT * FROM CODES WHERE CODE_TYPE = "SESSION" and CODE = :code';
        $statement = $this->connexion->prepare($query);
        $statement->execute([
            'code' => $code,
        ]);

        if ($statement->rowCount() > 1) {
            throw new MoreThanOneException("Problème présent dans la BD");
        }

        if ($statement->rowCount() === 0) {
            return false;
        }else {
            return true;
        }

    }
}