<?php

require '../GestionPage.php';

start_page('Mode Attaque');   //Charge la balise "head" avec le css, favicon et le nom de la page donner en parametre.
interfaces_view('Envoyez le palet dans la cage de la bonne réponse', 'puck', 'Palet');
end_page();