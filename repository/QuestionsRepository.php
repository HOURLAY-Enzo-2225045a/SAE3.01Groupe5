<?php

namespace App\Repository;

use App\Exception\NotFoundException;
use App\Model\Question;
use App\Model\User;

class QuestionsRepository extends AbstractRepository
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll() :  array{
        $query = 'SELECT * FROM QUESTION';
        $statement = $this->connexion->prepare($query);
        $statement->execute();

//        if ($statement->rowCount() === 0) {
//            throw new NotFoundException('Aucune question n\'a été trouvée ');
//        }

        //on créer un tableau de questions contenant toutes les données
        $arraySQL = $statement->fetchAll();
        $arrayQuestions = array();

        /* on récupére le résultat de la requête SQL et on le met dans un tableau d'User'*/
        for ($i = 0; $i < sizeof($arraySQL); $i++) {
            $question = new Question($arraySQL[$i]);
            $arrayQuestions[] = $question;
        }
        return $arrayQuestions;
    }

    public function createQuestion($text, $level) :  void{
        $query = "INSERT INTO QUESTION (QUESTION_ID, INTITULE, NIVEAU) VALUES (NULL, :text, :level);";
        $statement = $this->connexion->prepare($query);
        $statement->execute([
            ':text' => $text,
            ':level'=> $level]);
    }
}
