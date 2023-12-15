<?php

use App\controls\SignUpController;

include_once 'view/GestionPage.php';
include_once 'view/View.php';
require_once 'controls/SignUpController.php';

// chemin de l'URL demandée au navigateur
$url = $_GET['url'] ?? '';

// TODO: gerer les cookies
ini_set('session.gc_maxlifetime', 1800);
session_start();

$view = new View();
$signUpController = new SignUpController();

if (isset($_GET['action']) ) {
    if($_GET['action'] == 'signUp' && isset($_POST['pseudo'])&& isset($_POST['email'])
            && isset($_POST['password'])&& isset($_POST['password1'])  ) {

        $pseudo = htmlspecialchars($_POST['pseudo']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $password1 = htmlspecialchars($_POST['password1']);

        $signUpController->getSignUp($password,$password1,$pseudo,$email);
    }
}


if ('' == $url || '/' == $url || 'home' == $url) {

    $view->display('Home', 'view/home.php');

}elseif (preg_match('/^rules.*/', $url)) {
    if(preg_match('/^rules\/\w+$/', $url) && file_exists('view/' . $url . '.php')){
        $path = 'view/' . $url . '.php';
    }elseif ($url == 'rules') {
        $path = 'view/rules/rules.php';
    }else {
        header('refresh:0;url=/rules');
        $path = 'view/rules/rules.php';
    }
    $view->display('Admin', $path);

}elseif (preg_match('/^admin.*/', $url)) {
    if(preg_match('/^admin\/\w+$/', $url) && file_exists('view/' . $url . '.php')){
        $path = 'view/' . $url . '.php';
    }elseif ($url == 'admin') {
        $path = 'view/admin/admin.php';
    }else {
        header('refresh:0;url=/admin');
        $path = 'view/admin/admin.php';
    }
    $view->display('Admin', $path);

}elseif ('play' == $url) {

    $path = 'view/'. $url. '.php';
    $view->display('Jeu', $path);

}elseif ('signUp' == $url) {

    $path = 'view/'.$url . '.php';
    $view->display('signUp', $path);

}else {
    echo "zebi ca marche pas";
}