<?php
use App\controls\Controller;
use App\Repository\OutputData;
use App\Repository\UserRepository;

include_once './view/View.php';
include_once './controls/Controller.php';
include_once './repository/Connexion.php';
include_once './repository/AbstractRepository.php';
include_once './repository/UserRepository.php';
include_once './repository/OutputData.php';


// chemin de l'URL demandée au navigateur
$url = $_GET['url'] ?? '';
$url2 = $_GET['url2'] ?? '';

// TODO: gerer les cookies
ini_set('session.gc_maxlifetime', 1800);
session_start();

putenv("DB_HOCKEY_DSN=mysql:host=mysql-jeuspartiates.alwaysdata.net;dbname=jeuspartiates_bd");
putenv("DB_HOCKEY_USER=340307");
putenv("DB_HOCKEY_PASSWORD=Sparte300");

$view = new View();
$outPutData = new OutputData();
$userRepo = new UserRepository();
$controller = new Controller($outPutData);

//listes des mots dans l'url permettant d'accéder à une page
$actions = [
    'play' => 'Jeu',
    'rules' => 'Regles',
    'signUp' => 'Connexion',
];

if (isset($_GET['action']) ) {
    if($_GET['action'] == 'signUp' && isset($_POST['pseudo'])&& isset($_POST['email'])
            && isset($_POST['password'])&& isset($_POST['password1'])  ) {

        $pseudo = htmlspecialchars($_POST['pseudo']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $password1 = htmlspecialchars($_POST['password1']);

        $controller->getSignUp($password,$password1,$pseudo,$email,$userRepo);
    }
}

if ('' == $url || '/' == $url || 'home' == $url) {
    if ('home' != $url || '' != $url2)
        header('refresh:0;url=/home');

    if(isset($_SESSION['admin']) && $_SESSION['admin'])
        $path = 'view/homeAdmin.php';
    else
        $path = 'view/home.php';
    $view->display('Home', $path);

}elseif ('adminPages'== $url) {

    if( '' != $url2  && file_exists('view/' . $url . '/' . $url2 . '.php')){
        $path = 'view/' . $url . '/' . $url2 . '.php';
    }elseif ('' != $url2) {
        header('refresh:0;url=/adminPages');
    }else{
        $path = 'view/adminPages/admin.php';
    }
    $view->display('Admin', $path);

}elseif (isset($actions[$url])) {
    if('' != $url2)
        header('refresh:0;url=/'.$url);
    $path = 'view/' . $url . '.php';
    $view->display($actions[$url], $path);

}else {
    echo "zebi ca marche pas";
}