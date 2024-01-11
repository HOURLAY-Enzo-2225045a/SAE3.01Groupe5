<?php

namespace Controls;

use Exception\CannotCreateException;
use Exception\MoreThanOneException;
use Exception\NotFoundException;
use Random\RandomException;
use View\View;

class QuestionsController
{
    /**
     * @var mixed
     */
    private $repository;

    public function __construct()
    {
        $this->repository = new \Repository\QuestionsRepository();
    }


    public function showQuestions(): void
    {
        try{
            $path = 'view/adminPages/questions.php';
            View::display('Questions', $path, $this->repository->getAll());
        }
        catch (NotFoundException $ERROR){
            file_put_contents('log/HockeyGame.log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            echo $ERROR->getMessage();
        }
    }

    public function getRandomQuestion(): void
    {
        try{
            $question = $this->repository->getRandomQuestion();
            $temp = array('intitule' => $question->getIntitule(), 'faux1'=> $question->getNiveau(), 'faux2' => $question->getFaux2());
            echo json_encode($temp);
        }
        catch (MoreThanOneException $ERROR){
            file_put_contents('log/HockeyGame.log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            echo $ERROR->getMessage();
        }
    }

    public function createQuestion($text, $level, $vrai, $faux1, $faux2): void
    {
        try{
            $this->repository->createQuestion($text, $level, $vrai, $faux1, $faux2);
        }
        catch (CannotCreateException $ERROR){
            file_put_contents('log/HockeyGame.log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            echo $ERROR->getMessage();
        }
    }

    public function deleteQuestion($id): void
    {
        try{
            $this->repository->deleteQuestionById($id);
        }
        catch (NotFoundException $ERROR){
            file_put_contents('log/HockeyGame.log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            echo $ERROR->getMessage();
        }
    }

    public function updateQuestion($id,$text,$level, $vrai, $faux1, $faux2)
    {
        try{
            $this->repository->updateQuestionById($id, $text, $level, $vrai, $faux1, $faux2);
        }
        catch (NotFoundException $ERROR){
            file_put_contents('log/HockeyGame.log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            echo $ERROR->getMessage();
        }
    }

    public function searchQuestion($searchTerm)
    {
        $questions = $this->repository->search($searchTerm);
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

    public function showUpdateForm($url, $id)
    {
        $path='view/forms/'.$url.'.php';
        View::display('MISE A JOUR', $path, $this->repository->getById($id));
    }

    public function questionShowdown(){
        try {
            $listeQuestion =  $this->repository->getAll();
            foreach ($listeQuestion as $question){
                $trouver = rand(0,sizeof($listeQuestion));

            }

        }catch (RandomException $exception){

        }
    }



}