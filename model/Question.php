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
    private $response;
    private $false1;
    private $false2;

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param mixed $response
     */
    public function setResponse($response): void
    {
        $this->response = $response;
    }

    /**
     * @return mixed
     */
    public function getFalse1()
    {
        return $this->false1;
    }

    /**
     * @param mixed $false1
     */
    public function setFalse1($false1): void
    {
        $this->false1 = $false1;
    }

    /**
     * @return mixed
     */
    public function getFalse2()
    {
        return $this->false2;
    }

    /**
     * @param mixed $false2
     */
    public function setFalse2($false2): void
    {
        $this->false2 = $false2;
    }

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



}
