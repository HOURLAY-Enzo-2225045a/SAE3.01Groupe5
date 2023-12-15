<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Serious Game de hockey pour les Spartiate de Marseille"/>
    <link rel="icon" href="/image/favicon.ico" type="image/x-icon" />
    <title>Titre</title>
    <link id="theme" rel="stylesheet" href="Style/homeStyle.css">
</head>
    <body>
        <header>
            <div class="hamburger-menu" onclick="toggleMenu(this)">
                <div class="bar">
                    <button onclick="window.location.href='play'">Jouer</button>
                </div>
                <div class="bar">
                    <button onclick="window.location.href='rules'">Voir les regles</button>
                </div>
                <div class="bar">
                    <button onclick="window.location.href='admin'">Panneau administrateur</button>
                </div>
                <div class="bar">
                    <button onclick="window.location.href='signUp'">se connecter</button>
                </div>
            </div>
        </header>
        <section>
            <h3 class="centered-text">Tout pour être un pro</h3>
            <div class="button-container">
                <button class="buttonOne" onclick="window.location.href='Interface Jeu/DifficultyChoice.php'">Jouer</button>
                <button class="buttonTwo" onclick="window.location.href='rules/rules.php'">Les règles</button>
            </div>
        </section>
    </body>
</html>

