<?php

namespace App\Model;
/**
 * La classe User permet de gérer les utilisateurs
 *
 * @author BELABBAS-Rayane-2225010aa <Belabbas.rayane[@]etu.univ-amu.fr>
 */
class Spartiate extends Entity
{
    private $spart_id;
    private $lastName;
    private $name;
    private $number;

    /**
     * @return mixed
     */
    public function getSpartId()
    {
        return $this->spart_id;
    }

    /**
     * @param mixed $spart_id
     */
    public function setSpartId($spart_id): void
    {
        $this->spart_id = $spart_id;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number): void
    {
        $this->number = $number;
    }



}
