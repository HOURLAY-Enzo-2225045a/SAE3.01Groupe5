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

    public function deleteUser($id, $userRepo): void
    {
        try{
            $userRepo->deleteUserById($id);
        }
        catch (NotFoundException $ERROR){
            file_put_contents('log/HockeyGame.log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            echo $ERROR->getMessage();
        }
    }

    public function deleteQuestion($id, $questionsRepo): void
    {
        try{
            $questionsRepo->deleteQuestionById($id);
        }
        catch (NotFoundException $ERROR){
            file_put_contents('log/HockeyGame.log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            echo $ERROR->getMessage();
        }
    }
    public function deleteSpartiate($id, $spartiateRepo): void
    {
        try{
            $spartiateRepo->deleteSpartiateById($id);
        }
        catch (NotFoundException $ERROR){
            file_put_contents('log/HockeyGame.log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            echo $ERROR->getMessage();
        }
    }

    public function changeStar($id, $spartiatesRepo)
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

    public function updateQuestion($id,$text,$level, $questionsRepo)
    {
        try{
            $questionsRepo->updateQuestionById($id, $text, $level);
        }
        catch (NotFoundException $ERROR){
            file_put_contents('log/HockeyGame.log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            echo $ERROR->getMessage();
        }
    }

    public function updateSpartiate($id, $lastName, $name, $spartiatesRepo)
    {
        try{
            $spartiatesRepo->updateSpartiateById($id, $lastName, $name);
        }
        catch (NotFoundException $ERROR){
            file_put_contents('log/HockeyGame.log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            echo $ERROR->getMessage();
        }
    }

    public function searchQuestion($searchTerm, $repo)
    {
        $questions = $repo->search($searchTerm);
        foreach($questions as $question){
            echo '
            <div class="flex flex-col items-center justify-center w-full p-6 bg-white border border-gray-200 rounded-lg shadow-md">
                <div class="flex flex-row items-center justify-between w-full mt-2">
                    <p class="text-lg font-medium text-gray-800 mr-5"> '.$question->getIntitule().' </p>
                    <div class="flex flex-row space-x-2">
                        <a href="/updateQuestion&id='.$question->getQuestion_id().'" class="inline-block w-8 h-8 bg-customBlue hover:bg-blue-700 rounded cursor-pointer">
                            <img class="p-1" src="/assets/images/edit.svg" alt="Delete">
                        </a>
                        <a href="/questions?action=deleteQuestion&id='.$question->getIntitule().'" class="inline-block w-8 h-8 bg-red-500 hover:bg-red-700 rounded cursor-pointer">
                            <img class="p-1" src="/assets/images/trashcan.svg" alt="Delete">
                        </a>
                    </div>
                </div>
            </div>';
        }
    }
    public function searchSpartiate($searchTerm, $repo)
    {
        $questions = $repo->search($searchTerm);
        foreach($questions as $spartiate) {
            echo '
                <div class="flex flex-col items-center justify-center w-full p-6 bg-white border border-gray-200 rounded-lg shadow-md">
                    <img src="https://i.imgur.com/7z9J8ZC.jpg" alt="joueur" class="w-32 h-32 rounded-full">
                    <div class="flex flex-row items-center justify-between w-full mt-2">
                        <p class="text-lg font-medium text-gray-800 mr-5">' . $spartiate->getLastname() . ' ' . $spartiate->getName() . '</p>
                        <div class="flex flex-row space-x-2">
                            <div class="inline-block w-8 h-8 bg-customBlue hover:bg-blue-700 rounded cursor-pointer">
                                  <img class="p-1 star" data-spartiate-id="' . $spartiate->getSpart_id() . '" data-filled="' . $spartiate->isStarred() . '" src="' . ($spartiate->isStarred() ? "/assets/images/fullStar.svg" : "/assets/images/emptyStar.svg").'" alt="etoile du match">
                            </div>
                            <a href="/updateSpartiate&id=' . $spartiate->getSpart_id() . '" class="inline-block w-8 h-8 bg-customBlue hover:bg-blue-700 rounded">
                                <img class="p-1" src="/assets/images/edit.svg" alt="Edit">
                            </a>
                            <a href="/spartiates?action=deleteSpartiate&id=' . $spartiate->getSpart_id() . '" class="inline-block w-8 h-8 bg-red-500 hover:bg-red-700 rounded">
                                <img class="p-1" src="/assets/images/trashcan.svg" alt="Delete">
                            </a>
                        </div>
                    </div>
                </div>';
        }

    }

}