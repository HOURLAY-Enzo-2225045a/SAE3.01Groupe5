<?php

namespace Controls;

use Exception\MoreThanOneException;

class CodesController
{
    /**
     * @var mixed
     */
    private $repository;

    public function __construct()
    {
        $this->repository = new \Repository\CodesRepository();
    }

    public function checkSessionCode($code){
        try{
            if($this->repository->checkSessionCode($code)){
                $_SESSION['code'] = $code;
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
}