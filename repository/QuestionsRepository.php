<?php

namespace Repository;
use Exception\NotFoundException;
use Exception\MoreThanOneException;
use Model\Question;
use PDO;

class QuestionsRepository extends AbstractRepository
{

    public function __construct()
    {
        parent::__construct();
    }
    public function getById($id): Question
    {
        $query = 'SELECT * FROM QUESTION WHERE QUESTION_ID = :id';
        $statement = $this->connexion->prepare($query);
        $statement->execute(['id' => $id]);

        //Si la requête ne rend rien ça veut dire qu'il n'y a aucune question avec cette id
        if ($statement->rowCount() === 0) {
            throw new NotFoundException('Aucune QUESTION trouvée');
        }
        //exception imposible mais a prévoire car on ne peut insérer qu'une question du meme ID
        if ($statement->rowCount() > 1) {
            throw new MoreThanOneException("Problème présent dans la BD");
        }
        $question = $statement->fetch();
        return new Question($question);
    }

    public function getRandomQuestion(): Question
    {
        $query = 'SELECT * FROM QUESTION ORDER BY RAND() LIMIT 1;';
        $statement = $this->connexion->prepare($query);
        $statement->execute();

        //exception imposible mais a prévoire car on ne peut insérer qu'une question du meme ID
        if ($statement->rowCount() > 1) {
            throw new MoreThanOneException("Problème présent dans la BD");
        }
        $question = $statement->fetch();
        return new Question($question);
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

    public function createQuestion($text, $level, $vrai, $faux1, $faux2) :  void{
        $query = "INSERT INTO QUESTION (QUESTION_ID, INTITULE, NIVEAU) VALUES (NULL, :text, :level, :vrai, :faux1, :faux2);";
        $statement = $this->connexion->prepare($query);
        $statement->execute([
            ':text' => $text,
            ':level'=> $level,
            ':vrai' => $vrai,
            ':faux1' => $faux1,
            ':faux2' => $faux2]);
    }
    public function deleteQuestionById($id): void
    {
        //On supprime un question avec son id
        $query = 'DELETE FROM QUESTION WHERE QUESTION_ID = :id';
        $statement = $this->connexion->prepare($query);
        $statement->execute(['id' => $id]);

        //Si la requête ne rend rien ça veut dire qu'il n'y a aucun question avec cette id
        if ($statement->rowCount() === 0) {
            throw new NotFoundException('Aucun question trouvé');
        }
    }
    public function updateQuestionById($id, $text, $level, $vrai, $faux1, $faux2){
        $query = "UPDATE QUESTION SET INTITULE = :text, NIVEAU = :level, VRAI = :vrai, FAUX1 = :faux1, FAUX2 = :faux2  WHERE QUESTION_ID = :id;";
        $statement = $this->connexion->prepare($query);
        $statement->execute([
            ':text' => $text,
            ':level'=> $level,
            ':vrai' => $vrai,
            ':faux1' => $faux1,
            ':faux2' => $faux2,
            ':id' => $id]);
    }

    public function search($searchTerm)
    {
        $query = "SELECT * FROM QUESTION WHERE INTITULE LIKE :searchTerm LIMIT 5";
        $statement = $this->connexion->prepare($query);
        $statement->execute([':searchTerm' => "%$searchTerm%"]);

        $questions = [];
        while ($data = $statement->fetch(PDO::FETCH_ASSOC)) {
            $questions[] = new Question($data);
        }
        return $questions;
    }

}
