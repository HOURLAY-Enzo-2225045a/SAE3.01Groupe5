<?php
require_once 'Controller/SignUpController.php';

use App\Controller\SignUpController;

header('Location: View/Home.php');

if (isset($_POST['SignUp'])) {
    $controller = new SignUpController();
    $controller->getSignUp();

    header('Location: View/html.php');
}