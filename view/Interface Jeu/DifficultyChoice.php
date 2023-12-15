<!DOCTYPE html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Serious Game de hockey pour les Spartiate de Marseille"/>
    <link rel="icon" href="/image/favicon.ico" type="image/x-icon" />
    <title>Choix du poste</title>
    <link id="theme" rel="stylesheet" href="../Style/diffucultyChoiceStyle.css">
</head>
    <body>
        <img src="https://upload.wikimedia.org/wikipedia/fr/5/54/MHC_logo_2016.png" alt="Image de coin" class="corner-image">

        <button class="top-button" onclick="window.location.href='ChoixDePoste.php'">Choix du poste</button>

        <div class="clickable-container">
            <a href="AttackInterface.php" class="clickable-area">
                <p>Attaque</p>
                <img src="https://marseillehockeyclub.com/wp-content/uploads/2023/08/Plan-de-travail-1-copie-8-683x1024.jpg" alt="Image 1">
            </a>
            <a href="DefenseInterface.php" class="clickable-area">
                <p>Défense</p>
                <img src="https://marseillehockeyclub.com/wp-content/uploads/2023/08/Plan-de-travail-1-copie-8-683x1024.jpg" alt="Image 1">
            </a>
            <a href="GoalkeeperInterface.php" class="clickable-area">
                <p>Gardien</p>
                <img src="https://marseillehockeyclub.com/wp-content/uploads/2023/08/Plan-de-travail-1-copie-8-683x1024.jpg" alt="Image 1">
            </a>
        </div>

        <div class="button-container">
            <button class="left-button" onclick="window.location.href='../Home.php'">Accueil</button>
        </div>
    </body>
</html>