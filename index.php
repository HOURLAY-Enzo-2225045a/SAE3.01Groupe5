<?php

use View\View;
require 'vendor/autoload.php';

// chemin de l'URL demandée au navigateur
$url = $_GET['url'] ?? '';
ini_set('session.gc_lifetime', 5);
session_start();
if (isset($_SESSION['last_activity']) && time() - $_SESSION['last_activity'] > 1800) {
    session_unset();
    session_destroy();
    session_start();
}else {
    $_SESSION['last_activity'] = time();
}

// Gestion des actions
require 'controls/actionController.php';


//listes des mots dans l'url permettant d'accéder à une page
$pages = [
    'play' => 'Jeu de hockey',
    'rules' => 'Regles',
];
$forms = [
    'sessionCode' =>    'entrer le code',
    'admin' =>          'Connexion',
];
$adminForms = [
    'newQuestion' =>    'Nouvelle Question',
    'newSpartiate' =>   'Nouveau Spartiate',
];
$adminPages = [
    'questions' =>      'Questions',
    'spartiates' =>     'Spartiates',
    'users' =>          'Utilisateurs',
];
if ('' == $url || '/' == $url || 'home' == $url) {

    $path = 'view/home.php';
    View::display('Home', $path);

}elseif (isset($pages[$url])) {

    if($url == 'play' && !isset($_SESSION['code']))
        header('refresh:0;url=/sessionCode');
    $path = 'view/' . $url . '.php';
    if (!isset($error)) $error = '';
    View::display($pages[$url], $path, $error);

}elseif (isset($forms[$url])) {

    $path = 'view/forms/' . $url . '.php';
    if (!isset($error)) $error = '';
    View::display($forms[$url], $path, $error);

}elseif(empty($_SESSION['admin'])) {

    header('refresh:0;url=/admin');

}elseif (isset($adminForms[$url])) {

    $path = 'view/forms/' . $url . '.php';
    if (!isset($error)) $error = '';
    View::display($adminForms[$url], $path, $error);

}elseif (isset($adminPages[$url])) {

    $method = "show".ucfirst($url);
    $controller = $url.'Controller';
    if(method_exists($controller,$method)) {
        $controller->$method();
    }else {
        header('refresh:0;url=/404');
    }

}elseif ('updateQuestion' == $url || 'updateSpartiate' == $url && !empty($_GET['id'])) {

    if('updateQuestion' == $url)
        $questionsController->showUpdateForm($url,htmlspecialchars($_GET['id']));
    else
        $spartiatesController->showUpdateForm($url,htmlspecialchars($_GET['id']));

}else {
    View::display('Erreur', 'view/error.php');
}