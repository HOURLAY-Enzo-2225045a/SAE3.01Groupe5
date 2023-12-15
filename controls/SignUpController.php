<?php

namespace App\controls;

use App\Exception\CannotCreateException;
use App\Exception\EmptyFieldException;
use App\Exception\PasswordVerificationException;
use App\Repository\UserRepository;

class SignUpController
{

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
    public function getSignUp($password,$password1,$pseudo,$email) : void {
        //on recupère les information rentrer dans la formulaire par le User

        try{
            //on créer et récupère le User qui correspond dans la BD
            $user = new UserRepository();
            $user->signUp($password,$password1,$pseudo,$email);

        }
            //on catch si un champ de saisie est vide ou si on ne peut pas créer l'utilisateurs ou si les password données ne sont pas les même
        catch (EmptyFieldException | CannotCreateException | PasswordVerificationException $ERROR){
            //on fais un retour d'erreur
            file_put_contents('Log/HockeyGame.log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
        }
    }
}