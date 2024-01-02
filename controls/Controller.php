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
        //on recupère les information rentrer dans la formulaire par le User

        try{
            //on créer et récupère le User qui correspond dans la BD
            $userRepo->signUp($password,$password1,$pseudo,$email);

        }
            //on catch si un champ de saisie est vide ou si on ne peut pas créer l'utilisateurs ou si les password données ne sont pas les même
        catch (EmptyFieldException | CannotCreateException | PasswordVerificationException |MoreThanOneException | NotFoundException $ERROR){
            //on fais un retour d'erreur
            file_put_contents('log/HockeyGame.log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            echo $ERROR->getMessage();
        }
    }
    public function getScoreById($id,$userRepo) : void{
        try{

            $this->outputData->setOutputData($userRepo->getScoreByID($id));
        }

        catch (NotFoundException | MoreThanOneException $ERROR){
            file_put_contents('log/HockeyGame.log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            echo $ERROR->getMessage();
        }
    }

    public function showAdmin($userRepo): void
    {
        try{
            $path = 'view/adminPages/admin.php';
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
}