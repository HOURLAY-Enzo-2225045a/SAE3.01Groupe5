<?php
use App\Repository\QuestionsRepository;
use App\Repository\SpartiatesRepository;
use App\Repository\UserRepository;

include_once './view/View.php';
include_once './Controls/Controller.php';
include_once './Repository/Connexion.php';
include_once './Repository/AbstractRepository.php';
include_once './Repository/UserRepository.php';
include_once './Repository/SpartiatesRepository.php';
include_once './Repository/QuestionsRepository.php';
include_once './Model/Entity.php';
include_once './Model/Question.php';
include_once './Model/User.php';

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

$userRepo = new UserRepository();
$spartiatesRepo = new SpartiatesRepository();
$questionsRepo = new QuestionsRepository();
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
    View::display('Home', $path);

}elseif ('adminPages'== $url) {

    if( '' != $url2  && file_exists('view/' . $url . '/' . $url2 . '.php')){
        $method = "show".ucfirst($url2);
        if(method_exists($controller,$method)) {
            switch ($url2) {
                case 'admin':
                    $controller->$method($userRepo);
                    break;
                case 'spartiates':
                    $controller->$method($spartiatesRepo);
                    break;
                case 'questions':
                    $controller->$method($questionsRepo);
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
    View::display($actions[$url], $path);

}else {
    echo "zebi ca marche pas";
}