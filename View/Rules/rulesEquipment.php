<?php
require '../GestionPage.php';

start_page('Règles Officielles - Hockey sur glace');   //Charge la balise "head" avec le css, favicon et le nom de la page donner en parametre.
rules_start_page('Equipements');
?>

    <section>
        <p>L'équipement complet d'un joueur de Hockey sur glace se compose ainsi :
            Une crosses
            Des patins
            L'équipement de protection (casque, coudières, jambières, gants, etc.)
            L'uniforme de l'équipe

            Le gardien possède des protections suplémentaire ainsi qu’un crosse différente.</p>
    </section>

    <section>
        <p>Il existe 3 type de protection pour le casque :</p>
    </section>

<?php
rules_end_page('rulesGameSurface.php', 'rulesGame.php', 'Jeu');
end_page();
?>