<?php

namespace Controls;

use App\Exception\CannotCreateException;
use App\Exception\EmptyFieldException;
use App\Exception\MoreThanOneException;
use App\Exception\NotFoundException;
use App\Exception\PasswordVerificationException;
use App\Model\User;
use View;

class Controller
{

    /**
     * @var mixed
     */
    private $repository;

    public function __construct($repository)
    {
        $this->repository = $repository;
    }

}