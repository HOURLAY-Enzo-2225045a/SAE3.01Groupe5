<?php
namespace Controls;
require 'vendor/autoload.php';
$questionsController = new \Controls\QuestionsController();
$spartiatesController = new \Controls\SpartiatesController();
$usersController = new \Controls\UsersController();
$codesController = new \Controls\CodesController();

// Gestion de la connexion
if(isset($_GET['action']) && $_GET['action'] == 'logIn' && isset($_POST['pseudo']) && isset($_POST['password'])){

    $pseudo = htmlspecialchars($_POST['pseudo']);
    $password = htmlspecialchars($_POST['password']);
    if($usersController->logIn($pseudo,$password)) {
        $url = 'users';
    }else
        $error = 'identifiant ou mot de passe incorrect';
}
if(isset($_GET['action']) && $_GET['action'] == 'checkSessionCode' && isset($_POST['code'])){
    $code = htmlspecialchars($_POST['code']);
    if($codesController->checkSessionCode($code)) {
        $_SESSION['code'] = $code;
        header('refresh:0;url=/play');
    }else
        $error = 'code incorrect';
}

// Gestion des actions dans l'url et envoyées en AJAX
if (((isset($_GET['action']) && $_GET['action'] != 'logIn' && $_GET['action'] != 'checkSessionCode') || (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) && !empty($_SESSION['admin'])) {
    $action = $_GET['action'] ?? $_POST['action'];
    $postData = $_POST;
    $actionsMapping = [
        'createSpartiate' => ['fields' => ['lastName', 'name'],                     'controller' => $spartiatesController,  'redirect' => '/spartiates'],
        'createQuestion' => [ 'fields' => ['text', 'level'],                        'controller' => $questionsController,   'redirect' => '/questions' ],
        'deleteUser' => [     'idField' => 'id',                                    'controller' => $usersController,        'redirect' => '/users'     ],
        'deleteQuestion' => [ 'idField' => 'id',                                    'controller' => $questionsController,   'redirect' => '/questions' ],
        'deleteSpartiate' => ['idField' => 'id',                                    'controller' => $spartiatesController,  'redirect' => '/spartiates'],
        'updateQuestion' => [ 'idField' => 'id', 'fields' => ['text', 'level'],     'controller' => $questionsController,   'redirect' => '/questions' ],
        'updateSpartiate' => ['idField' => 'id', 'fields' => ['lastName', 'name'],  'controller' => $spartiatesController,  'redirect' => '/spartiates'],
        'changeStar' => [     'fields' => ['spartiateId'],                          'controller' => $spartiatesController                              ],
        'searchQuestion' => [ 'fields' => ['searchTerm'],                           'controller' => $questionsController                               ],
        'searchSpartiate' => ['fields' => ['searchTerm'],                           'controller' => $spartiatesController                              ],
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
        if (!isset($mapping['controller']))
            die("pas de controlleur associé a l'action");
        else
            call_user_func_array([$mapping['controller'], $action], $params);

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