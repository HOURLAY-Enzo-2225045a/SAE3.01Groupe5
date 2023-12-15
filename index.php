<?php
require_once 'Controller/SignUpController.php';
require_once 'Repository/Connexion.php';
require_once 'Repository/AbstractRepository.php';
require_once 'Repository/UserRepository.php';
require_once 'Model/User.php';

include_once 'Exception/CannotCreateException.php';
include_once 'Exception/EmptyFieldException.php';
include_once 'Exception/MoreThanOneException.php';
include_once 'Exception/NotFoundException.php';
include_once 'Exception/PasswordVerificationException.php';

use App\Controller\SignUpController;

header('Location: View/Home.php');

if (isset($_POST['SignUp'])) {
    $controller = new SignUpController();

    $controller->getSignUp();

    header('Location: View/html.php');
}