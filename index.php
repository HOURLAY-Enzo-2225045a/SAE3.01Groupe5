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
}
elseif ('regles' == $url) {

    $pageName = ucfirst($url) . '.php';
    $view->display('Home', 'view/Rules/'.$pageName);

}else {
    echo "zebi ca marche pas";
}