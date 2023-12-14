<?php

require '../GestionPage.php';

start_page('Mode defense');   //Charge la balise "head" avec le css, favicon et le nom de la page donner en parametre.
interfaces_view('Foncez sur le joueur de la bonne réponse', 'defender', 'Defenseur');
end_page();