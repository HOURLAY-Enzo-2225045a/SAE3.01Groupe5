<?php

use App\Controls\Controller;
use App\Repository\QuestionsRepository;
use App\Repository\SpartiatesRepository;
use App\Repository\UserRepository;

include_once './view/View.php';
include_once './controls/Controller.php';
include_once './repository/Connexion.php';
include_once './repository/AbstractRepository.php';
include_once './repository/UserRepository.php';
include_once './repository/SpartiatesRepository.php';
include_once './repository/QuestionsRepository.php';
include_once './model/Entity.php';
include_once './model/Question.php';
include_once './model/User.php';
include_once './model/Spartiate.php';
include_once './exception/NotFoundException.php';

// chemin de l'URL demandée au navigateur
$url = $_GET['url'] ?? '';
$url2 = $_GET['url2'] ?? '';

// TODO: gerer les cookies
ini_set('session.gc_maxlifetime', 1800);
session_start();
$_SESSION['users'] = true;

putenv("DB_HOCKEY_DSN=mysql:host=mysql-jeuspartiates.alwaysdata.net;dbname=jeuspartiates_bd");
putenv("DB_HOCKEY_USER=340307");
putenv("DB_HOCKEY_PASSWORD=Sparte300");

$userRepo = new UserRepository();
$spartiatesRepo = new SpartiatesRepository();
$questionsRepo = new QuestionsRepository();
$controller = new Controller();

//listes des mots dans l'url permettant d'accéder à une page
$pages = [
    'play' => 'Jeu',
    'rules' => 'Regles',
];
$forms = [
    'signUp' => 'Connexion',
    'newQuestion' => 'Nouvelle Question',
    'newSpartiate' => 'Nouveau Spartiate',
];

if (isset($_GET['action']) ) {

    if($_GET['action'] == 'signUp' && !empty($_POST['pseudo'])&& !empty($_POST['email'])
            && !empty($_POST['password'])&& !empty($_POST['password1'])) {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $password1 = htmlspecialchars($_POST['password1']);
        $controller->getSignUp($password,$password1,$pseudo,$email,$userRepo);
    }

    if($_GET['action'] == 'spartiateCreation' && !empty($_POST['lastName'])&& !empty($_POST['name'])) {
        $lastName = htmlspecialchars($_POST['lastName']);
        $name = htmlspecialchars($_POST['name']);
        $controller->createSpartiate($lastName, $name, $spartiatesRepo);
        header("refresh:0;url=/adminPages/spartiates");
    }

    if($_GET['action'] == 'questionCreation' && !empty($_POST['text'])&& !empty($_POST['level'])) {
        $text = htmlspecialchars($_POST['text']);
        $level = htmlspecialchars($_POST['level']);
        $controller->createQuestion($text, $level, $questionsRepo);
        header("refresh:0;url=/adminPages/questions");
    }

    if($_GET['action'] == 'deleteUser' && !empty($_GET['id'])) {
        $controller->deleteUserById(htmlspecialchars($_GET['id']), $userRepo);
        header("refresh:0;url=/adminPages/users");
    }
    if($_GET['action'] == 'deleteQuestion' && !empty($_GET['id'])) {
        $controller->deleteQuestionById(htmlspecialchars($_GET['id']), $questionsRepo);
        header("refresh:0;url=/adminPages/questions");
    }
    if($_GET['action'] == 'deleteSpartiate' && !empty($_GET['id'])) {
        $controller->deleteSpartiateById(htmlspecialchars($_GET['id']), $spartiatesRepo);
        header("refresh:0;url=/adminPages/spartiates");
    }

    if($_GET['action'] == 'questionUpdate' && !empty($_GET['id']) && !empty($_POST['text'])&& !empty($_POST['level'])) {
        $text = htmlspecialchars($_POST['text']);
        $level = htmlspecialchars($_POST['level']);
        $controller->updateQuestionById(htmlspecialchars($_GET['id']),$text,$level, $questionsRepo);
        header("refresh:0;url=/adminPages/questions");
    }
    if($_GET['action'] == 'spartiateUpdate' && !empty($_GET['id']) && !empty($_POST['lastName'])&& !empty($_POST['name'])) {
        $lastName = htmlspecialchars($_POST['lastName']);
        $name = htmlspecialchars($_POST['name']);
        $controller->updateSpartiateById(htmlspecialchars($_GET['id']),$lastName,$name, $spartiatesRepo);
        header("refresh:0;url=/adminPages/spartiates");
    }



    if($_GET['action'] == 'changeStar' && !empty($_GET['id'])) {
        $controller->changeSpartiateStarById(htmlspecialchars($_GET['id']), $spartiatesRepo);
        header("refresh:0;url=/adminPages/spartiates");
    }

}

if ('' == $url || '/' == $url || 'home' == $url) {
    if ('home' != $url || !empty($url2)) {
        header('refresh:0;url=/home');
        return;
//    if(isset($_SESSION['users']) && $_SESSION['users'])
//        $path = 'view/homeAdmin.php';
    }else
        $path = 'view/home.php';
    View::display('Home', $path);

}elseif ('adminPages'== $url) {
    if( !empty($url2)  && file_exists('view/' . $url . '/' . $url2 . '.php')){
        $method = "show".ucfirst($url2);
        if(method_exists($controller,$method)) {
            switch ($url2) {
                case 'users':
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
        header('refresh:0;url=/adminPages/users');
        return;
    }

}elseif (isset($pages[$url])) {

    if(!empty($url2))
        header('refresh:0;url=/'.$url);
    $path = 'view/' . $url . '.php';
    View::display($pages[$url], $path);

}elseif (('updateQuestion' == $url || 'updateSpartiate' == $url && !empty($url2))) {
    if('updateQuestion' == $url)
        $controller->showUpdateForm($url,$url2, $questionsRepo);
    else
        $controller->showUpdateForm($url,$url2, $spartiatesRepo);


}elseif (isset($forms[$url])) {
    if(!empty($url2))
        header('refresh:0;url=/'.$url);

    $path = 'view/forms/' . $url . '.php';
    View::display($forms[$url], $path);
}else {
    echo "zebi ca marche pas";
}