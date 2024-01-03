<?php

namespace App\Controls;

use App\Exception\CannotCreateException;
use App\Exception\EmptyFieldException;
use App\Exception\MoreThanOneException;
use App\Exception\NotFoundException;
use App\Exception\PasswordVerificationException;
use View;

class Controller
{

    public function __construct()
    {

    }


    /**
     * permet de créer un nouveau User et le connecter
     *
     * @catch CannotCreateUserException
     * @catch PasswordVerificationException
     * @catch NotFoundException
     *
     * @param $password
     * @param $password1
     * @param $pseudo
     * @param $email
     * @return void
     */
    public function getSignUp($password,$password1,$pseudo,$email,$userRepo) : void {
        //on recupère les information rentrée dans la formulaire par le User
        try{
            //on créer et récupère le User qui correspond dans la BD
            $userRepo->signUp($password,$password1,$pseudo,$email);
        }
            //on catch si un champ de saisie est vide ou si on ne peut pas créer l'utilisateurs ou si les password donnés ne sont pas les mêmes
        catch (EmptyFieldException | CannotCreateException | PasswordVerificationException |MoreThanOneException | NotFoundException $ERROR){
            //on fais un retour d'erreur
            file_put_contents('log/HockeyGame.log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            echo $ERROR->getMessage();
        }
    }

    public function showUsers($userRepo): void
    {
        try{
            $path = 'view/adminPages/users.php';
            View::display('Admin', $path, $userRepo->userRanking());
        }
        catch (NotFoundException $ERROR){
            file_put_contents('log/HockeyGame.log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            echo $ERROR->getMessage();
        }
    }

    public function showSpartiates($spartiatesRepo): void
    {
        try{
            $path = 'view/adminPages/spartiates.php';
            View::display('Spartiates', $path, $spartiatesRepo->getAll());
        }
        catch (NotFoundException $ERROR){
            file_put_contents('log/HockeyGame.log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            echo $ERROR->getMessage();
        }
    }

    public function showQuestions($questionsRepo): void
    {
        try{
            $path = 'view/adminPages/questions.php';
            View::display('Questions', $path, $questionsRepo->getAll());
        }
        catch (NotFoundException $ERROR){
            file_put_contents('log/HockeyGame.log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            echo $ERROR->getMessage();
        }
    }

    public function createSpartiate($lastName, $name, $spartiateRepo) : void{
        try{
            $spartiateRepo->createSpartiate($lastName, $name);
        }
        catch (CannotCreateException $ERROR){
            file_put_contents('log/HockeyGame.log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            echo $ERROR->getMessage();
        }
    }

    public function createQuestion($text, $level, $questionsRepo): void
    {
        try{
            $questionsRepo->createQuestion($text, $level);
        }
        catch (CannotCreateException $ERROR){
            file_put_contents('log/HockeyGame.log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            echo $ERROR->getMessage();
        }
    }

    public function deleteUserById($id, $userRepo): void
    {
        try{
            $userRepo->deleteUserById($id);
        }
        catch (NotFoundException $ERROR){
            file_put_contents('log/HockeyGame.log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            echo $ERROR->getMessage();
        }
    }

    public function deleteQuestionById($id, $questionsRepo): void
    {
        try{
            $questionsRepo->deleteQuestionById($id);
        }
        catch (NotFoundException $ERROR){
            file_put_contents('log/HockeyGame.log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            echo $ERROR->getMessage();
        }
    }
    public function deleteSpartiateById($id, $spartiateRepo): void
    {
        try{
            $spartiateRepo->deleteSpartiateById($id);
        }
        catch (NotFoundException $ERROR){
            file_put_contents('log/HockeyGame.log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            echo $ERROR->getMessage();
        }
    }

    public function changeSpartiateStarById($id, $spartiatesRepo)
    {
        try{
            if($spartiatesRepo->isStarredById($id) === 1)
                $spartiatesRepo->changeSpartiateStarById($id, 0);
            else
                $spartiatesRepo->changeSpartiateStarById($id, 1);

        }
        catch (NotFoundException $ERROR){
            file_put_contents('log/HockeyGame.log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            echo $ERROR->getMessage();
        }
    }

    public function showUpdateForm($url, $url2, $repo)
    {
        $path='view/forms/'.$url.'.php';
        View::display('MISE A JOUR', $path, $repo->getById($url2));
    }

    public function updateQuestionById($id,$text,$level, $questionsRepo)
    {
        try{
            $questionsRepo->updateQuestionById($id, $text, $level);
        }
        catch (NotFoundException $ERROR){
            file_put_contents('log/HockeyGame.log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            echo $ERROR->getMessage();
        }
    }

    public function updateSpartiateById($id, $lastName, $name, $spartiatesRepo)
    {
        try{
            $spartiatesRepo->updateSpartiateById($id, $lastName, $name);
        }
        catch (NotFoundException $ERROR){
            file_put_contents('log/HockeyGame.log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            echo $ERROR->getMessage();
        }
    }

}