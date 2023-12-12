<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Choix du poste</title>
        <link rel="stylesheet" href="style.css">
        <script src="script.js"></script>
    </head>

    <body>
        <h3>Foncer sur le joueur de la bonne réponse</h3>
        <h3 id="Question">Question</h3>
        <section>
            <button id="Answer" name="answer1" onclick="window.location.href='../EndGame/LoseView.php'">Reponse1</button>
            <button id="Answer" name="answer2" onclick="window.location.href='../EndGame/WinView.php'">Reponse2</button>
            <button id="Answer" name="answer3" onclick="window.location.href='../EndGame/LoseView.php'">Reponse3</button>
        </section>
        <section>
            <object id="defender">Defenseur</object>
        </section>
    </body>

    <footer>

    </footer>
</html>