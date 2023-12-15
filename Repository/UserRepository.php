<?php

namespace App\Repository;

use App\Exception\CannotCreateException;
use App\Exception\EmptyFieldException;
use App\Exception\MoreThanOneException;
use App\Exception\NotFoundException;
use App\Exception\PasswordVerificationException;
use App\Model\User;

class UserRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct();
    }
    public function login(string $pseudo , string $password) : User
    {
        //on select tout les Users avec le même pseudo et password
        $query = 'SELECT * FROM USER WHERE PSEUDO = :pseudo and PASSWORD = :password';
        $statement = $this->connexion -> prepare( $query );
        $statement->execute(['pseudo' => $pseudo , 'password' => $password]);

        //Si la fonction ne rend rien cela veut dire qu'il n'y a pas de User correspondant
        if ( $statement -> rowCount() === 0 ){
            throw new NotFoundException("L'utilisateur de pseudo : ".$pseudo." n'a pas été trouvé");
        }
        if ( $statement -> rowCount() > 1 ){
            throw new MoreThanOneException("Deux utilisateurs de pseudo : ".$pseudo." avec le même mot de passe ont été trouvé");
        }

        $user = $statement->fetch();

        return new User($user['USER_ID'],$user['PASSWORD'],$user["PSEUDO"],$user['MAIL'],$user['SCORE']);
    }

    public function signUp(string $password, string $password1,string $pseudo, string $email): User {

        if ($password === "" || $password1 === "" || $pseudo === "" || $email === "" ){
            throw new EmptyFieldException("Un champ de saisie est vide");
        }

        //On vérifie si les confirmations de password sont bon
        if ($password != $password1){
            throw new PasswordVerificationException("Mot de passe différent");
        }

        //on insert dans la BD le nouvel utilisateur
        $query = 'INSERT INTO USER (PASSWORD, PSEUDO, MAIL, SCORE) VALUES (:password, :pseudo, :email,0)';
        $statement = $this->connexion -> prepare( $query );
        $statement->execute(['password' => $password, 'pseudo'=> $pseudo, 'email' => $email]);

        //Si la requête ne nous rend rien on dit que l'on peut pas insérer
        if ( $statement -> rowCount() === 0){
            throw new CannotCreateException("Le USER de pseudo : ".$pseudo." ne peut pas être créer");
        }
        //Exception imposible mais a prévoire car on ne peut insérer qu'un User
        if ( $statement -> rowCount() > 1){
            throw new MoreThanOneException("Le USER de pseudo : ".$pseudo." ne peut être créer qu'une fois");
        }

        return $this->login($pseudo,$password);
    }
}