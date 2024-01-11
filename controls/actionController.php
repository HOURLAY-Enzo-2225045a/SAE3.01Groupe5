<?php

namespace Controls;

require __DIR__ . '/../vendor/autoload.php';

// Utiliser un tableau pour stocker les instances des contrôleurs
$questionsController = new \Controls\QuestionsController();
$spartiatesController = new \Controls\SpartiatesController();
$usersController = new \Controls\UsersController();
$codesController = new \Controls\CodesController();
$controllers = [
    'questions' => new QuestionsController(),
    'spartiates' => new SpartiatesController(),
    'users' => new UsersController(),
    'codes' => new CodesController(),
];

if (!isset($_SESSION)) {
    session_start();
}

// Fonction pour traiter les actions
function handleAction($postData, $questionsController, $spartiatesController, $usersController, $codesController, $files)
{
    $action = $_POST['action'];
    $actionsMapping = [
        'logIn' => ['fields' => ['pseudo', 'password'], 'controller' => $usersController, 'success' => ['success' => true, 'url' => 'users'], 'error' => ['success' => false, 'error' => 'Identifiant ou mot de passe incorrect'], 'adminOnly' => false],
        'checkSessionCode' => ['fields' => ['code'], 'controller' => $codesController, 'success' => ['success' => true, 'url' => 'play'], 'error' => ['success' => false, 'error' => 'code incorrect'], 'adminOnly' => false],
        'createSpartiate' => ['fields' => ['lastName', 'name'],                     'controller' => $spartiatesController,  'redirect' => '/spartiates', 'adminOnly' => true],
        'createQuestion' => [ 'fields' => ['text', 'level'],                        'controller' => $questionsController,   'redirect' => '/questions', 'adminOnly' => true ],
        'deleteUser' => [     'idField' => 'id',                                    'controller' => $usersController,        'redirect' => '/users', 'adminOnly' => true     ],
        'deleteQuestion' => [ 'idField' => 'id',                                    'controller' => $questionsController,   'redirect' => '/questions', 'adminOnly' => true ],
        'deleteSpartiate' => ['idField' => 'id',                                    'controller' => $spartiatesController,  'redirect' => '/spartiates', 'adminOnly' => true],
        'updateQuestion' => [ 'idField' => 'id', 'fields' => ['text', 'level'],     'controller' => $questionsController,   'redirect' => '/questions', 'adminOnly' => true ],
        'updateSpartiate' => ['idField' => 'id', 'fields' => ['lastName', 'name'],  'controller' => $spartiatesController,  'redirect' => '/spartiates', 'adminOnly' => true],
        'changeStar' => [     'fields' => ['spartiateId'],                          'controller' => $spartiatesController , 'adminOnly' => true                             ],
        'searchQuestion' => [ 'fields' => ['searchTerm'],                           'controller' => $questionsController   , 'adminOnly' => true                            ],
        'searchSpartiate' => ['fields' => ['searchTerm'],                           'controller' => $spartiatesController, 'adminOnly' => true                             ],
        ];

    if (isset($actionsMapping[$action])) {
        $mapping = $actionsMapping[$action];
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
            $id = htmlspecialchars($_POST[$mapping['idField']]);
            $params[] = $id;
        }
        foreach ($mapping['fields'] ?? [] as $field) {
            $params[] = htmlspecialchars($postData[$field]);
        }
        //je verifie si mon controller existe
        if (!isset($mapping['controller']))
            echo json_encode('Action non valide');

        elseif(!$mapping['adminOnly']){
            // Appeler la fonction appropriée avec les paramètres
            header('Content-Type: application/json');

            if (call_user_func_array([$mapping['controller'], $action], $params)) {
                echo json_encode($mapping['success']);
            } else {
                echo json_encode($mapping['error']);
            }
        }else{
            $controllers = $mapping['controller'];
            // Appeler la fonction appropriée avec les paramètres
           call_user_func_array([$controllers, $action], $params);
        }

        if(isset($files["fileToUpload"])){
            $target_dir = "../assets/fileSave/";
            $imageFileType = strtolower(pathinfo(basename($files["fileToUpload"]["name"]),PATHINFO_EXTENSION));
            $target_file = $target_dir . strtolower($postData['lastName']) . "_" . strtolower($postData['name'] . "." . $imageFileType);

            // restreindre au extensions d'image
            if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif" ) {
                move_uploaded_file(str_replace("\\\\", "\\", $files["fileToUpload"]["tmp_name"]), $target_file);
            }
        }

////         Redirection
        if (isset($mapping['redirect'])) {
            echo $mapping['redirect'];
        }
    } else {
        // Gérer les actions non valides
        echo 'Action non valide';
    }
}

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && !empty($_POST['action']) && $_POST['action'] != 'getRandomQuestion') {
    // Utilisation de la fonction si la requete ajax est detectée
    handleAction($_POST, $questionsController, $spartiatesController, $usersController, $codesController,$_FILES);
} elseif(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && !empty($_POST['action']) && $_POST['action'] == 'getRandomQuestion') {
    // Utilisation de la fonction si la requete ajax est detectée
    $questionsController->getRandomQuestion();
}
