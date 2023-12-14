<?php

namespace App\Controller;


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
     * @return void
     */
    public function getSignUp() : void {
        //on recupère les information rentrer dans la formulaire par le User
        $pseudo = $_POST['pseudo'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $password1 = md5($_POST['password1']);

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