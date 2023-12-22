<?php

namespace App\Repository;

class OutputData
{
    private $outputData;

    public function __destruct()
    {
        $this->outputData = null;
    }

    public function getOutputData()
    {
        return $this->outputData;
    }

    public function setOutputData($data)
    {
        $this->outputData = $data;
    }

}