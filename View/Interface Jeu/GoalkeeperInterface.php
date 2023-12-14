<?php

require '../GestionPage.php';

start_page('Mode gardien');   //Charge la balise "head" avec le css, favicon et le nom de la page donner en parametre.
interfaces_view('Denfendez la cage de la bonne réponse', 'goalkeeper', 'Gardien');
end_page();