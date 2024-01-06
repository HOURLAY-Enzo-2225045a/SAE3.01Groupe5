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

// Gestion des actions dans l'url et envoyées en AJAX
if (isset($_GET['action']) || (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
    $action = $_GET['action'] ?? $_POST['action'];
    $postData = $_POST;

    $actionsMapping = [
//        'signUp' => ['fields' => ['pseudo', 'email', 'password', 'password1'], 'repo' => $userRepo],
        'signUp' => [         'fields' => ['pseudo', 'email', 'password', 'password1'], 'repo' => $userRepo],
        'createSpartiate' => ['fields' => ['lastName', 'name'],                     'repo' => $spartiatesRepo,  'redirect' => '/spartiates'],
        'createQuestion' => [ 'fields' => ['text', 'level'],                        'repo' => $questionsRepo,   'redirect' => '/questions'],
        'deleteUser' => [     'idField' => 'id',                                    'repo' => $userRepo,        'redirect' => '/users'],
        'deleteQuestion' => [ 'idField' => 'id',                                    'repo' => $questionsRepo,   'redirect' => '/questions'],
        'deleteSpartiate' => ['idField' => 'id',                                    'repo' => $spartiatesRepo,  'redirect' => '/spartiates'],
        'updateQuestion' => [ 'idField' => 'id', 'fields' => ['text', 'level'],     'repo' => $questionsRepo,   'redirect' => '/questions'],
        'updateSpartiate' => ['idField' => 'id', 'fields' => ['lastName', 'name'],  'repo' => $spartiatesRepo,  'redirect' => '/spartiates'],
        'changeStar' => [     'fields' => ['spartiateId'],                          'repo' => $spartiatesRepo,],
        'searchQuestion' => [ 'fields' => ['searchTerm'],                           'repo' => $questionsRepo,],
        'searchSpartiate' => ['fields' => ['searchTerm'],                           'repo' => $spartiatesRepo,],
    ];

    if (isset($actionsMapping[$action])) {
        $mapping = $actionsMapping[$action];
        // Vérifier la présence des champs requis pour les actions avec POST
        if (isset($mapping['fields'])) {
            foreach ($mapping['fields'] as $field) {
                if (empty($postData[$field])) {
                    die("Champ $field manquant");
                }
            }
        }
        // Récupérer les paramètres de l'action
        if (isset($mapping['idField'])) {
            $id = htmlspecialchars($_GET[$mapping['idField']]);
            $params = [$id];
        } else {
            $params = [];
        }
        foreach ($mapping['fields'] ?? [] as $field) {
            $params[] = htmlspecialchars($postData[$field]);
        }

        // Appeler la fonction appropriée avec les paramètres
        call_user_func_array([$controller, $action], array_merge($params, [$mapping['repo']]));

//      Redirection
        if (isset($mapping['redirect'])) {
            header("refresh:0;url={$mapping['redirect']}");
        }
        return;
    } else {
        // Gérer les actions non valides
        die("Action non valide");
    }
}

if ('' == $url || '/' == $url || 'home' == $url) {
    if ('home' != $url || !empty($url2)) {
        header('refresh:0;url=/home');
        return;
    }else
        $path = 'view/home.php';
    View::display('Home', $path);

}elseif (file_exists('view/adminPages/' . $url . '.php')) {
    $method = "show".ucfirst($url);
    if(method_exists($controller,$method)) {
        switch ($url) {
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
    }else {
        header('refresh:0;url=/view/404.php');
        return;
    }

}elseif (isset($pages[$url])) {
    if(!empty($url2))
        header('refresh:0;url=/'.$url);
    $path = 'view/' . $url . '.php';
    View::display($pages[$url], $path);

}elseif (('updateQuestion' == $url || 'updateSpartiate' == $url && !empty($_GET['id']))) {
    if('updateQuestion' == $url)
        $controller->showUpdateForm($url,htmlspecialchars($_GET['id']), $questionsRepo);
    else
        $controller->showUpdateForm($url,htmlspecialchars($_GET['id']), $spartiatesRepo);

}elseif (isset($forms[$url])) {
    if(!empty($url2))
        header('refresh:0;url=/'.$url);
    $path = 'view/forms/' . $url . '.php';
    View::display($forms[$url], $path);
}else {
    echo "zebi ca marche pas";
}