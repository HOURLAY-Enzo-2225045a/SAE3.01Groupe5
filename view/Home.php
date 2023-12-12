<?php

require 'GestionPage.php';

start_page('Acceuil');//Charge la balise "head" avec le css, favicon et le nom de la page donner en parametre.
?>
    <section>
        <button onclick="window.location.href='Interface Jeu/DifficultyChoice.php'">Jouer</button>
        <button onclick="window.location.href='Rules/Regles.php'">Règles</button>
    </section>