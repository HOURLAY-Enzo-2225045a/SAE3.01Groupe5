<?php

namespace Repository;
use Exception\NotFoundException;
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

    public function createQuestion($text, $level, $true, $false1, $false2) :  void{
        $query = "INSERT INTO QUESTION (QUESTION_ID, INTITULE, NIVEAU, RESPONSE, FALSE1, FALSE2) VALUES (NULL, :text, :level, :true, :false1, :false2);";
        $statement = $this->connexion->prepare($query);
        $statement->execute([
            ':text' => $text,
            ':level'=> $level,
            ':true'=> $true,
            ':false1'=> $false1,
            ':false2'=> $false2]);

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
    public function updateQuestionById($id, $text, $level){
        $query = "UPDATE QUESTION SET INTITULE = :text, NIVEAU = :level WHERE QUESTION_ID = :id;";
        $statement = $this->connexion->prepare($query);
        $statement->execute([
            ':text' => $text,
            ':level'=> $level,
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
