<?php

namespace App\Repository;

class OutputData
{
    protected $outputData;

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