<?php

use App\Controls\Controller;
use App\Repository\CodesRepository;
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
include_once './repository/CodesRepository.php';
include_once './model/Entity.php';
include_once './model/Question.php';
include_once './model/User.php';
include_once './model/Spartiate.php';
include_once './exception/NotFoundException.php';

// chemin de l'URL demandée au navigateur
$url = $_GET['url'] ?? '';
// TODO: gerer les cookies
ini_set('session.gc_lifetime', 5);
session_start();
if (isset($_SESSION['last_activity']) && time() - $_SESSION['last_activity'] > 1800) {
    session_unset();
    session_destroy();
    session_start();
}else {
    $_SESSION['last_activity'] = time();
}

$userRepo = new UserRepository();
$spartiatesRepo = new SpartiatesRepository();
$questionsRepo = new QuestionsRepository();
$codesRepo = new CodesRepository();
$controller = new Controller();

//listes des mots dans l'url permettant d'accéder à une page
$pages = [
    'play' => 'Play',
    'rules' => 'Regles',
];
$forms = [
    'code' =>           ['Code', 'admin'],
    'admin' =>          ['Connexion', 'admin'],
    'newQuestion' =>    ['Nouvelle Question'],
    'newSpartiate' =>   ['Nouveau Spartiate'],
];


// Gestion de la connexion
if(isset($_GET['action']) && $_GET['action'] == 'logIn' && isset($_POST['pseudo']) && isset($_POST['password'])){

    $pseudo = htmlspecialchars($_POST['pseudo']);
    $password = htmlspecialchars($_POST['password']);
    if($controller->logIn($pseudo,$password,$userRepo)) {
        $url = 'users';
    }else
        $error = 'identifiant ou mot de passe incorrect';
}

// Gestion des actions dans l'url et envoyées en AJAX
if (((isset($_GET['action']) && $_GET['action'] != 'logIn') || (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) && !empty($_SESSION['admin'])) {
    $action = $_GET['action'] ?? $_POST['action'];
    $postData = $_POST;
    $actionsMapping = [
        'createSpartiate' => ['fields' => ['lastName', 'name'],                     'repo' => $spartiatesRepo,  'redirect' => '/spartiates'],
        'createQuestion' => [ 'fields' => ['text', 'level'],                        'repo' => $questionsRepo,   'redirect' => '/questions' ],
        'deleteUser' => [     'idField' => 'id',                                    'repo' => $userRepo,        'redirect' => '/users'     ],
        'deleteQuestion' => [ 'idField' => 'id',                                    'repo' => $questionsRepo,   'redirect' => '/questions' ],
        'deleteSpartiate' => ['idField' => 'id',                                    'repo' => $spartiatesRepo,  'redirect' => '/spartiates'],
        'updateQuestion' => [ 'idField' => 'id', 'fields' => ['text', 'level'],     'repo' => $questionsRepo,   'redirect' => '/questions' ],
        'updateSpartiate' => ['idField' => 'id', 'fields' => ['lastName', 'name'],  'repo' => $spartiatesRepo,  'redirect' => '/spartiates'],
        'changeStar' => [     'fields' => ['spartiateId'],                          'repo' => $spartiatesRepo                              ],
        'searchQuestion' => [ 'fields' => ['searchTerm'],                           'repo' => $questionsRepo                               ],
        'searchSpartiate' => ['fields' => ['searchTerm'],                           'repo' => $spartiatesRepo                              ],
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
    $path = 'view/home.php';
    View::display('Home', $path);

}elseif (isset($pages[$url])) {
    $path = 'view/' . $url . '.php';
    if (!isset($error)) $error = '';
    View::display($pages[$url], $path, $error);

}elseif (isset($forms[$url]) ) {
    $path = 'view/forms/' . $url . '.php';
    if (!isset($error)) $error = '';
    View::display($forms[$url][0], $path, $error);

}elseif(empty($_SESSION['admin'])) {
    header('refresh:0;url=/admin');
}
elseif (file_exists('view/adminPages/' . $url . '.php')) {
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

}elseif ('updateQuestion' == $url || 'updateSpartiate' == $url && !empty($_GET['id'])) {
    if('updateQuestion' == $url)
        $controller->showUpdateForm($url,htmlspecialchars($_GET['id']), $questionsRepo);
    else
        $controller->showUpdateForm($url,htmlspecialchars($_GET['id']), $spartiatesRepo);

}else {
    echo "zebi ca marche pas";
}