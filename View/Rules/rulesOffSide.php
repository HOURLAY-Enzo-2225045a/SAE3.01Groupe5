<?php

require '../GestionPage.php';

start_page('Règles Officielles - Hockey sur glace');   //Charge la balise "head" avec le css, favicon et le nom de la page donner en parametre.
rules_start_page('Le Hors Jeu');
?>

    <section>
        <p>Un joueur qui attaque n’a pas le droit de précéder le palet dans la zone d’attaque. C’est ce qu’on appelle le hors-jeu. Autre règle très importante, celle du dégagement interdit. On appelle un dégagement interdit quand le palet tiré depuis la demie défensive franchit la ligne de but adverse alors que les deux équipes sont à force égale ou que l’équipe qui attaque est en supériorité numérique.</p>
    </section>

    <section>
        <button onclick="window.location.href='../../index.php'">Retour à l'accueil</button>
        <button onclick="window.location.href='rulesGame.php'">Précédant</button>
    </section>

<?php end_page(); ?>