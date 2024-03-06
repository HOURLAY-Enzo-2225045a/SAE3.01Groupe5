<?php

namespace Controls;

class WSController
{
    public function __construct()
    {
    }

    public function connexionWS(){
        $identificationMessage = array(
            'action' => 'identify',
            'id' => $_SESSION['id'] ?? 1,
            'admin' => !empty($_SESSION['admin']),
        );

        // Convertir le tableau associatif en JSON
        $jsonIdentificationMessage = json_encode($identificationMessage);

        echo $jsonIdentificationMessage;
    }
}