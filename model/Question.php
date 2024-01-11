<?php

namespace Model;
/**
 * La classe User permet de gérer les utilisateurs
 *
 * @author BELABBAS-Rayane-2225010aa <Belabbas.rayane[@]etu.univ-amu.fr>
 */
class Question extends Entity
{
    private $question_id;
    private $intitule;
    private $niveau;
    private $vrai;
    private $faux1;
    private $faux2;

    /**
     * @return mixed
     */
    public function getQuestion_id()
    {
        return $this->question_id;
    }

    /**
     * @param mixed $question_id
     */
    public function setQuestion_id($question_id): void
    {
        $this->question_id = $question_id;
    }

    /**
     * @return mixed
     */
    public function getIntitule()
    {
        return $this->intitule;
    }

    /**
     * @param mixed $intitule
     */
    public function setIntitule($intitule): void
    {
        $this->intitule = $intitule;
    }

    /**
     * @return mixed
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * @param mixed $niveau
     */
    public function setNiveau($niveau): void
    {
        $this->niveau = $niveau;
    }

    /**
     * @return mixed
     */
    public function getVrai()
    {
        return $this->vrai;
    }

    /**
     * @param mixed $vrai
     */
    public function setVrai($vrai): void
    {
        $this->niveau = $vrai;
    }

    /**
     * @return mixed
     */
    public function getFaux1()
    {
        return $this->faux1;
    }

    /**
     * @param mixed $faux1
     */
    public function setFaux1($faux1): void
    {
        $this->niveau = $faux1;
    }

    /**
     * @return mixed
     */
    public function getFaux2()
    {
        return $this->faux2;
    }

    /**
     * @param mixed $faux2
     */
    public function setFaux2($faux2): void
    {
        $this->niveau = $faux2;
    }

}
