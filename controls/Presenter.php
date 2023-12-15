<?php

namespace App\controls;

class Presenter
{
    private $outputData;

    public function __construct($outputData)
    {
        $this->outputData = $outputData;
    }

    public function show($presenterName)
    {
        $data = $this->outputData->getOutputData();
        extract(array('data' => $data));
        ob_start();
        require '/controls/presenters/' . $presenterName . '.php';
        return ob_get_clean();
    }
}