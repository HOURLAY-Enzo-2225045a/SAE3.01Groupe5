<?php

namespace Controls;

use App\Exception\MoreThanOneException;

class codesController
{
    /**
     * @var mixed
     */
    private $repository;

    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function checkSessionCode($code){
        try{
            return $this->repository->checkSessionCode($code);
        }
        catch (MoreThanOneException $ERROR){
            //on fais un retour d'erreur
            file_put_contents('log/HockeyGame.log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            echo $ERROR->getMessage();
        }
    }
}