<?php

namespace Controls;

use Exception\MoreThanOneException;
use Exception\NotFoundException;
use View\View;

class SessionController
{
    /**
     * @var mixed
     */
    private $repository;

    public function __construct()
    {
        $this->repository = new \Repository\SessionRepository();
    }

    public function addSessionPlayer($pseudo){
        $this->repository->addSessionPlayer($pseudo, $_SESSION['code']);
        $_SESSION['pseudo'] = $pseudo;
    }

    public function showUsers(): void
    {
        $path = 'view/adminPages/users.php';
        View::display('Admin', $path, $this->repository->getRanking());
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