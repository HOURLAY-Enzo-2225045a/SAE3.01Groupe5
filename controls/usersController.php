<?php

namespace Controls;

use App\Exception\MoreThanOneException;
use App\Exception\NotFoundException;

class usersController
{
    /**
     * @var mixed
     */
    private $repository;

    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function logIn($pseudo,$password){
        //on recupère les information rentrées dans le formulaire
        try{
            $user = $this->repository->logIn($pseudo,$password);
            if( !empty($user) && $user->getAdmin() == 1){
                $_SESSION['admin'] = true;
                return true;
            }else {
                return false;
            }
        }
        catch (MoreThanOneException $ERROR){
            //on fais un retour d'erreur
            file_put_contents('log/HockeyGame.log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            echo $ERROR->getMessage();
        }
    }

    public function showUsers(): void
    {
        try{
            $path = 'view/adminPages/users.php';
            View::display('Admin', $path, $this->repository->userRanking());
        }
        catch (NotFoundException $ERROR){
            file_put_contents('log/HockeyGame.log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            echo $ERROR->getMessage();
        }
    }

    public function deleteUser($id): void
    {
        try{
            $this->repository->deleteUserById($id);
        }
        catch (NotFoundException $ERROR){
            file_put_contents('log/HockeyGame.log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            echo $ERROR->getMessage();
        }
    }
}