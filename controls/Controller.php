<?php

namespace Controls;

use Exception\CannotCreateException;
use Exception\EmptyFieldException;
use Exception\MoreThanOneException;
use Exception\NotFoundException;
use Exception\PasswordVerificationException;
use Model\User;
use View;

class Controller
{
    /**
     * @var mixed
     */
    private $repositories;

    public function __construct($repositories)
    {
        $this->$repositories = $repositories;
    }

}