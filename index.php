<?php
use App\controls\Controller;
use App\Repository\SpartiatesRepository;
use App\Repository\UserRepository;

include_once './view/View.php';
include_once './controls/Controller.php';
include_once './repository/Connexion.php';
include_once './repository/AbstractRepository.php';
include_once './repository/UserRepository.php';
include_once './repository/SpartiatesRepository.php';
include_once './model/Entity.php';
include_once './model/User.php';

// chemin de l'URL demandée au navigateur
$url = $_GET['url'] ?? '';
$url2 = $_GET['url2'] ?? '';

// TODO: gerer les cookies
ini_set('session.gc_maxlifetime', 1800);
session_start();
$_SESSION['admin'] = true;

putenv("DB_HOCKEY_DSN=mysql:host=mysql-jeuspartiates.alwaysdata.net;dbname=jeuspartiates_bd");
putenv("DB_HOCKEY_USER=340307");
putenv("DB_HOCKEY_PASSWORD=Sparte300");

$view = new View();
$userRepo = new UserRepository();
$spartiatesRepo = new SpartiatesRepository();
$controller = new Controller();

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

    if ('home' != $url || !empty($url2)) {
        header('refresh:0;url=/home');
        return;
//    if(isset($_SESSION['admin']) && $_SESSION['admin'])
//        $path = 'view/homeAdmin.php';
    }else
        $path = 'view/home.php';
    $view->display('Home', $path);

}elseif ('adminPages'== $url) {

    if( '' != $url2  && file_exists('view/' . $url . '/' . $url2 . '.php')){
        $method = "show".ucfirst($url2);
        if(method_exists($controller,$method)) {
            switch ($url2) {
                case 'spartiates':
                    $controller->$method($spartiatesRepo, $view);
                    break;
                case 'admin':
                    $controller->$method($userRepo, $view);
                    break;
            }
        }
    }else {
        header('refresh:0;url=/adminPages/admin');
        return;
    }

}elseif (isset($actions[$url])) {

    if(!empty($url2))
        header('refresh:0;url=/'.$url);
    $path = 'view/' . $url . '.php';
    $view->display($actions[$url], $path);

}else {
    echo "zebi ca marche pas";
}