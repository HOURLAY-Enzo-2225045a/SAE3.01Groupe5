<?php
require 'view/GestionPage.php';
include_once 'view/View.php';

// chemin de l'URL demandée au navigateur
$url = $_GET['url'] ?? '';

// TODO: gerer les cookies
ini_set('session.gc_maxlifetime', 1800);
session_start();

$view = new View();

if ('' == $url || '/' == $url || 'home' == $url) {

    $pageName = ucfirst($url); ;
    $view->display('Home', 'view/Home.php');

}elseif ('rules' == $url) {
    if(isset($_GET['page']) && filter_var($_GET['page'], FILTER_VALIDATE_INT) !== false && $_GET['page'] >= 1 && $_GET['page'] <= 4){
        $pageName = $url . $_GET['page'] . '.php';
    }elseif(isset($_GET['page']))
        header('refresh:0;url=rules');
    else{
        $pageName = $url . '.php';
    }
    $view->display('Regles', 'view/rules/'.$pageName);

}elseif ('admin' == $url) {

    $pageName = ucfirst($url) . '.php';
    $view->display('Admin', 'view/'.$pageName);

}elseif ('play' == $url) {

    $pageName = ucfirst($url) . '.php';
    $view->display('Jeu', 'view/'.$pageName);

}else {
    echo "zebi ca marche pas";
}