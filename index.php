<?php
include_once 'view/GestionPage.php';
include_once 'view/View.php';

// chemin de l'URL demandée au navigateur
$url = $_GET['url'] ?? '';

// TODO: gerer les cookies
ini_set('session.gc_maxlifetime', 1800);
session_start();

$view = new View();

if ('' == $url || '/' == $url || 'home' == $url) {

    $path = ucfirst($url); ;
    $view->display('Home', 'view/Home.php');

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

    $path = ucfirst($url) . '.php';
    $view->display('Jeu', 'view/'.$path);

}else {
    echo "zebi ca marche pas";
}