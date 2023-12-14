<?php

require '../GestionPage.php';

start_page('Règles Officielles - Hockey sur glace');   //Charge la balise "head" avec le css, favicon et le nom de la page donner en parametre.
rules_start_page('Surface de jeu');
?>

    <section>
        <p>La patinoire est divisée en 3 zones, délimitées par 2 lignes bleues: la zone d’attaque, la zone neutre (au milieu) et la zone de défense.</p>
        <p>La zone de défense est comprise entre la balustrade derrière le but défendu par l’équipe et la première ligne bleue. Cette zone comprend également une ligne rouge fine, appelée ligne de but, sur laquelle est placé le but à défendre.</p>
        <p>La zone neutre, quant à elle, est la partie de la patinoire comprise entre les deux lignes bleues. Au milieu de la zone, une ligne rouge aussi épaisse que les lignes bleues symbolise le milieu de la glace et est appelée la ligne rouge centrale. </p>
        <p>Enfin, la zone d’attaque va de la deuxième ligne bleue à la
            bande derrière le but défendu par l’équipe adverse.
            Elle comprend également l’autre ligne de but de la patinoire,
            sur laquelle est positionné le but adverse.</p>
    </section>

<?php
rules_end_page('rulesIndex.php', 'rulesEquipment.php', 'Equipement');
end_page();
?>