<?php

namespace Controls;

require __DIR__ . '/../vendor/autoload.php';

// Utiliser un tableau pour stocker les instances des contrôleurs
$controllers = [
    'questions' => new QuestionsController(),
    'spartiates' => new SpartiatesController(),
    'users' => new UsersController(),
    'codes' => new CodesController(),
];

if (!isset($_SESSION)) {
    session_start();
}

// Fonction pour vérifier si la requête est une requête AJAX
function isAjaxRequest()
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && !empty($_POST['action']);
}

// Fonction pour traiter les actions
function handleAction($action, $postData, $controllers)
{
    $actionsMapping = [
        'logIn' => ['fields' => ['pseudo', 'password'], 'controller' => $controllers['users'], 'success' => ['success' => true, 'url' => 'users'], 'error' => ['success' => false, 'error' => 'Erreur lors de la création de Spartiate'], 'adminOnly' => false],
        'checkCode' => ['fields' => ['code'], 'controller' => $controllers['code'], 'success' => ['success' => true, 'url' => 'play'], 'error' => ['success' => false, 'error' => 'code incorrect'], 'adminOnly' => false],
        'createSpartiate' => ['fields' => ['lastName', 'name'],                     'controller' => $controllers['spartiates'],  'redirect' => '/spartiates', 'adminOnly' => true],
        'createQuestion' => [ 'fields' => ['text', 'level'],                        'controller' => $controllers['question'],   'redirect' => '/questions', 'adminOnly' => true ],
        'deleteUser' => [     'idField' => 'id',                                    'controller' => $controllers['users'],        'redirect' => '/users', 'adminOnly' => true     ],
        'deleteQuestion' => [ 'idField' => 'id',                                    'controller' => $controllers['question'],   'redirect' => '/questions', 'adminOnly' => true ],
        'deleteSpartiate' => ['idField' => 'id',                                    'controller' => $controllers['spartiates'],  'redirect' => '/spartiates', 'adminOnly' => true],
        'updateQuestion' => [ 'idField' => 'id', 'fields' => ['text', 'level'],     'controller' => $controllers['question'],   'redirect' => '/questions', 'adminOnly' => true ],
        'updateSpartiate' => ['idField' => 'id', 'fields' => ['lastName', 'name'],  'controller' => $controllers['spartiates'],  'redirect' => '/spartiates', 'adminOnly' => true],
        'changeStar' => [     'fields' => ['spartiateId'],                          'controller' => $controllers['spartiates'] , 'adminOnly' => true                             ],
        'searchQuestion' => [ 'fields' => ['searchTerm'],                           'controller' => $controllers['question']   , 'adminOnly' => true                            ],
        'searchSpartiate' => ['fields' => ['searchTerm'],                           'controller' => $controllers['spartiates'], 'adminOnly' => true                             ],
        ];

    if (isset($actionsMapping[$action])) {
        $mapping = $actionsMapping[$action];
        echo 'test';
        // Vérifier si l'action nécessite des privilèges administratifs
        if ($mapping['adminOnly'] && empty($_SESSION['admin'])) {
            echo json_encode(['success' => false, 'error' => 'Vous n\'avez pas les droits administratifs nécessaires.']);
            return;
        }

        // Vérifier la présence des champs requis pour les actions avec POST
        if (isset($mapping['fields'])) {
            foreach ($mapping['fields'] as $field) {
                if (empty($postData[$field])) {
                    echo json_encode(['success' => false, 'error' => "Champ $field manquant"]);
                    return;
                }
            }
        }
        // Récupérer les paramètres de l'action
        $params = [];
        if (isset($mapping['idField'])) {
            $id = htmlspecialchars($_GET[$mapping['idField']]);
            $params[] = $id;
        }
        foreach ($mapping['fields'] ?? [] as $field) {
            $params[] = htmlspecialchars($postData[$field]);
        }
        //je verifie si mon controller existe
        if (!isset($mapping['controller']))
            echo json_encode(['error' => 'Action non valide']);

        elseif(!$mapping['adminOnly']){
            // Appeler la fonction appropriée avec les paramètres
            header('Content-Type: application/json');
            if (call_user_func_array([$mapping['controller'], $action], $params)) {
                echo json_encode($mapping['success']);
            } else {
                echo json_encode($mapping['error']);
            }
        }else{
            // Appeler la fonction appropriée avec les paramètres
           call_user_func_array([$mapping['controller'], $action], $params);

        }

        // Redirection
        if (isset($mapping['redirect'])) {
            header("refresh:0;url={$mapping['redirect']}");
        }
    } else {
        // Gérer les actions non valides
        echo json_encode(['error' => 'Action non valide']);
    }
}

if (isAjaxRequest()) {
    // Utilisation de la fonction factorisée
    handleAction($_POST['action'], $_POST, $controllers);
} elseif (isAjaxRequest() && !empty($_SESSION['admin'])) {
    // Utilisation de la fonction factorisée
    handleAction($_POST['action'], $_POST, $controllers);
}
