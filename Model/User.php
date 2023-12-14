<?php

namespace App\Model;
/**
 * La classe User permet de gérer les utilisateurs
 *
 * @author BELABBAS-Rayane-2225010aa <Belabbas.rayane[@]etu.univ-amu.fr>
 */
class User
{
    /**
     * Le constructeur de la class User
     *
     * @param int $userId => l'id du user
     * @param string $password => mot de passe du User
     * @param string $pseudo => nom d'affichage du User
     * @param string $email => addresse mail du User
     * @param int $score => le score du User
     */
    public function __construct(private int $userId , private string $password, private string $pseudo,
                                private string $email, private int $score)
    {

    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): void
    {
        $this->pseudo = $pseudo;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function setScore(int $score): void
    {
        $this->score = $score;
    }

}
